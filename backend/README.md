# Laravel Backend Pinterest Clone 
this is backend for Pinterest Clone apps. I build this using [laravel](https://laravel.com/) + [sanctum](https://laravel.com/docs/11.x/sanctum) for the API and [tailwind](https://tailwindcss.com/) + [flyonui](https://flyonui.com/docs/getting-started/quick-start/) in admin view. I also use laravel breeze for admin authentication. 

## Requirements
- PHP >= 8.2
- npm/bun/deno/pnpm ( btw i use bun, because its fast :) )

## How to run?
- make sure you have clone [this repository](https://github.com/Hasban-Fardani/pinterest-clone.git)
- go to the backend folder
- install dependencies by run:
```bash
# for php packages
composer install

# for node js packages
bun install 
# or
npm install
# or other nodejs package manager
```
- copy .env.example to .env
- edit .env file on database section, please customize with your database configuration
- migrate the database
```bash
php artisan migrate

# this is optional if you want to use dummy data
php artisan db:seed
```
- generate app key by run this command:
```bash
php artisan key:generate
```
- build css and js (if on production)
```bash
npm run build
# or 
bun run build

# if on dev environment:
npm run dev
```
- run the project
```bash
php artisan serve
```
## API Documentation
you can visit to this [link](https://hasban-fardani.github.io/pinterest-clone/backend/public/docs/)

## Libraries
- [Laravel 11.x](https://laravel.com/docs/11.x)
- [Laravel Sanctum](https://laravel.com/docs/11.x/sanctum)
- [Tailwind CSS](https://tailwindcss.com/)
- [Flyonui](https://flyonui.com/)
