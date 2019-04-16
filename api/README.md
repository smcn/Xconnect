# api_app_test

composer install

cp .env.example .env

php artisan key:generate

php artisan jwt:secret

nano .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=omuservices_test
DB_USERNAME=omuservices_test
DB_PASSWORD=qazwsx

php artisan migrate --seed
