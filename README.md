# MX100 - Freelancer Marketplace API

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve

API Base URL
http://localhost:8000/api