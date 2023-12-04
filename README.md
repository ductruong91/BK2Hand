## BK2Hand là gì ?

Một ứng dụng web trao đổi, mua bán sản phẩm cũ cho khoá học ITSS học bằng tiếng Nhật 2

## Mục lục

- [System requirements](#system-requirements)
- [Setup and Configuration](#setup-and-configuration)
- [Usage](#usage)

## System requirements

- Composer
- Node
- Xampp

## Setup and Configuration

To get a local copy of the project up and running, follow these steps:

1. Install dependencies

```bash
composer require
npm install
```
2. Copy .env.example file to .env and generate key

```bash
cp .env.example .env
php artisan key:generate
```
3. Migrate and seed dummy data

```bash
php artisan migrate --seed
```
## Usage

To start the application locally, use the following commands:

```bash
php artisan serve
```
The application will be accessible at: [http://project.localhost:8000](http://project.localhost:8000)

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

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.
