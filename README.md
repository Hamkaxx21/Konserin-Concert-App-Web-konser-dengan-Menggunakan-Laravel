<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development/)**
- **[Active Logic](https://activelogic.com)**

## Memulai Proyek

Ikuti langkah-langkah berikut untuk mengatur dan menjalankan proyek Laravel ini di komputer Anda:

### Prasyarat

Pastikan Anda telah menginstal perangkat lunak berikut di sistem Anda:

- [PHP](https://www.php.net/) >= 8.0
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) dan npm
- Server database (contoh: MySQL, PostgreSQL, SQLite)

### Instalasi

1. Clone repositori:
   ```bash
   git clone <repository-url>
   cd Konserin-New
   ```

2. Instal dependensi PHP:
   ```bash
   composer install
   ```

3. Instal dependensi JavaScript:
   ```bash
   npm install
   ```

4. Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```

5. Generate the application key:
   ```bash
   php artisan key:generate
   ```

### Database Setup

1. Buat database dengan nama konserin_db (e.g., `konserin`).

2. Update file `.env` sesuai dengan nama database yang telah di setup:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=konserin_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. Run the database migrations:
   ```bash
   php artisan migrate
   ```

4. (Optional) Seed the database with sample data:
   ```bash
   php artisan db:seed
   ```

### Running the Application

1. Start the development server:
   ```bash
   php artisan serve
   ```

2. Compile the frontend assets:
   ```bash
   npm run dev
   ```

3. Open your browser and navigate to `http://127.0.0.1:8000`.

### Additional Tips

- If you encounter permission issues, make sure the `storage` and `bootstrap/cache` directories are writable:
  ```bash
  chmod -R 775 storage bootstrap/cache
  ```

- To run tests:
  ```bash
  php artisan test
  ```

- For production, use `npm run build` to compile assets and configure a web server like Nginx or Apache.

### Troubleshooting

- If you encounter issues, check the Laravel [documentation](https://laravel.com/docs) or the [community forums](https://laracasts.com/discuss).

Feel free to reach out if you have any questions or need further assistance!

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Fitur Booking Status
Fitur ini sedang dikembangkan di branch `fitur-booking-status` untuk menampilkan status booking konser.

## Catatan Developer
Ini adalah penambahan manual untuk memastikan Git mendeteksi perubahan di branch `fitur-booking-status`.
