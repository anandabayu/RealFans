## How to Run

- copy `.env.example` to `.env`
- configure database connection, google-client key and stripe key
- run `composer install`
- run `php artisan key:generate`
- run `php artisan migrate`
- run `php artisan storage:link`
- run `php artisan serve` then open `http://127.0.0.1:8000` in your browser
