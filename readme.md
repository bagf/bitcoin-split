## Bitcoin/Litecoin automated split

## Installation

```sh
composer install
cp .env.example .env
php artisan key:generate
```

Configure your database settings by editing `.env` them run artisan migrate to create the tables.

```sh
php artisan migrate
```

## Running it locally

```sh
php artisan serv
```
