<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\Booking;
use App\Models\BookingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the booking page for an event.
     */
    public function create($slug)
    {
        $event = Event::where('slug', $slug)
                      ->with('tickets')
                      ->firstOrFail();
        
        return view('bookings.create', compact('event'));
    }

    /**
     * Add tickets to cart.
     */
    public function addToCart(Request $request, $slug)
    {
        $validated = $request->validate([
            'tickets' => 'required|array',
            'tickets.*.id' => 'required|exists:tickets,id',
            'tickets.*.quantity' => 'required|integer|min:0',
        ]);
        
        $event = Event::where('slug', $slug)->firstOrFail();
        $tickets = $validated['tickets'];
        
        // Initialize cart if it doesn't exist
        if (!session()->has('cart')) {
            session()->put('cart', []);
        }
        
        $cart = session()->get('cart', []);
        
        foreach ($tickets as $ticketData) {
            if ($ticketData['quantity'] <= 0) {
                continue; // Skip tickets with zero quantity
            }
            $ticket = Ticket::findOrFail($ticketData['id']);
            
            // Check if ticket belongs to the event
            if ($ticket->event_id !== $event->id) {
                return redirect()->back()->with('error', 'Invalid ticket selected.');
            }
            
            // Check if quantity is available
            if ($ticketData['quantity'] > $ticket->available) {
                return redirect()->back()->with('error', 'Not enough tickets available.');
            }
            
            // Check if the ticket already exists in the cart, update quantity if so
            $found = false;
            foreach ($cart as &$cartItem) {
                if ($cartItem['ticket_id'] === $ticket->id) {
                    $cartItem['quantity'] += $ticketData['quantity'];
                    $cartItem['subtotal'] = $cartItem['price'] * $cartItem['quantity'];
                    $found = true;
                    break;
                }
            }
            unset($cartItem);
            
            if (!$found) {
                // Add new item to cart
                $cartItem = [
                    'event_id' => $event->id,
                    'event_title' => $event->title,
                    'event_date' => $event->formatted_date,
                    'ticket_id' => $ticket->id,
                    'ticket_name' => $ticket->name,
                    'quantity' => $ticketData['quantity'],
                    'price' => $ticket->price,
                    'subtotal' => $ticket->price * $ticketData['quantity'],
                ];
                $cart[] = $cartItem;
            }
        }
        
        session()->put('cart', $cart);
        
        // Redirect to checkout page after adding to cart
        return redirect()->route('checkout')->with('success', 'Tickets added to cart successfully! Please proceed to payment.');
    }

    /**
     * Display the cart.
     */
    public function cart()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_column($cart, 'subtotal'));
        
        return view('bookings.cart', compact('cart', 'total'));
    }

    /**
     * Remove an item from the cart.
     */
    public function removeFromCart($index)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$index])) {
            unset($cart[$index]);
            $cart = array_values($cart); // Reindex array
            session()->put('cart', $cart);
            return redirect()->route('cart')->with('success', 'Item removed from cart.');
        }
        
        return redirect()->route('cart')->with('error', 'Item not found in cart.');
    }

    /**
     * Display the checkout page.
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Your cart is empty.');
        }
        
        $total = array_sum(array_column($cart, 'subtotal'));
        
        // Get available payment methods
        $paymentMethods = [
            'credit_card' => 'Credit Card',
            'bank_transfer' => 'Bank Transfer',
            'e_wallet' => 'E-Wallet',
        ];
        
        return view('bookings.checkout', compact('cart', 'total', 'paymentMethods'));
    }

    /**
     * Process the checkout.
     */
    public function process(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => 'required|string|in:credit_card,bank_transfer,e_wallet',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Your cart is empty.');
        }

        $total = array_sum(array_column($cart, 'subtotal'));

        // Simulate payment success regardless of payment method
        DB::beginTransaction();

        try {
            $eventItems = [];
            foreach ($cart as $item) {
                $eventId = $item['event_id'];
                if (!isset($eventItems[$eventId])) {
                    $eventItems[$eventId] = [];
                }
                $eventItems[$eventId][] = $item;
            }

            foreach ($eventItems as $eventId => $items) {
                $eventTotal = array_sum(array_column($items, 'subtotal'));

                $booking = new Booking([
                    'user_id' => auth()->id(),
                    'event_id' => $eventId,
                    'booking_number' => Booking::generateBookingNumber(),
                    'total_amount' => $eventTotal,
                    'payment_status' => 'paid', // Mark as paid immediately
                    'payment_method' => $validated['payment_method'],
                ]);

                $booking->save();

                foreach ($items as $item) {
                    $bookingItem = new BookingItem([
                        'booking_id' => $booking->id,
                        'ticket_id' => $item['ticket_id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'subtotal' => $item['subtotal'],
                    ]);

                    $bookingItem->save();

                    $ticket = Ticket::find($item['ticket_id']);
                    $ticket->available -= $item['quantity'];
                    $ticket->save();
                }
            }

            session()->forget('cart');

            DB::commit();

            // Store booking number in session and redirect to success page
            session(['booking_number' => $booking->booking_number]);

            return redirect()->route('bookings.success')->with('success', 'Booking completed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred while processing your booking. Please try again.');
        }
    }

    /**
     * Display the booking success page.
     */
    public function success()
    {
        $bookingNumber = session('booking_number');
        
        if (!$bookingNumber) {
            return redirect()->route('home');
        }
        
        $booking = Booking::where('booking_number', $bookingNumber)
                          ->where('user_id', auth()->id())
                          ->with(['event', 'bookingItems.ticket'])
                          ->first();
        
        if (!$booking) {
            return redirect()->route('home');
        }
        
        return view('bookings.success', compact('booking'));
    }

    /**
     * Display the user's bookings.
     */
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())
                           ->with('event')
                           ->orderBy('created_at', 'desc')
                           ->paginate(10);
        
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Display the booking details.
     */
    public function show($bookingNumber)
    {
        $booking = Booking::where('booking_number', $bookingNumber)
                          ->where('user_id', auth()->id())
                          ->with(['event', 'bookingItems.ticket'])
                          ->firstOrFail();
        
        return view('bookings.show', compact('booking'));
    }
}
