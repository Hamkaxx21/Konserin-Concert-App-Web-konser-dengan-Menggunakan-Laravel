<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Bagaimana cara membeli tiket konser?',
                'answer' => 'Anda dapat membeli tiket dengan login, memilih konser, dan klik "Beli Tiket" untuk melanjutkan ke pembayaran.'
            ],
            [
                'question' => 'Apakah saya bisa refund tiket?',
                'answer' => 'Tiket yang sudah dibeli tidak dapat di-refund, kecuali konser dibatalkan oleh penyelenggara.'
            ],
            [
                'question' => 'Metode pembayaran apa yang tersedia?',
                'answer' => 'Kami mendukung pembayaran melalui transfer bank, e-wallet, dan kartu kredit.'
            ],
            [
                'question' => 'Bagaimana cara melihat tiket saya?',
                'answer' => 'Setelah pembayaran berhasil, tiket bisa dilihat di halaman "Akun Saya" > "Tiket Saya".'
            ]
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
