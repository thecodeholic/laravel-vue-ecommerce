# Laravel E-commerce Website
E-commerce application built with Laravel, Vue.js, Tailwind.css and Alpine.js. <br>

> If you want to see every single step how this E-commerce application is build and learn how to build your own Full Stack applications, check my website [thecodeholic.com](https://thecodeholic.com)

## Demo
Admin Panel: https://admin.lcommerce.net
```
Email: admin@example.com
Password: admin123
```

Website: https://lcommerce.net

```
Email: user1@example.com
Password: useruser1


Email: user2@example.com
Password: useruser2
```

## Installation 
Make sure you have environment setup properly. You will need MySQL, PHP8.1 and composer.

### Install Laravel Website + API
1. Download the project (or clone using GIT)
2. Copy `.env.example` into `.env` and configure database credentials
3. Navigate to the project's root directory using terminal
4. Run `composer install`
5. Set the encryption key by executing `php artisan key:generate --ansi`
6. Run migrations `php artisan migrate --seed`
7. Start local server by executing `php artisan serve`
8. Open new terminal and navigate to the project root directory
9. Run `npm install`
10. Run `npm run dev` to start vite server for Laravel frontend

### Install Vue.js Admin Panel
1. Navigate to `backend` folder
2. Run `npm install`
3. Copy `backend/.env.example` into `backend/.env`
4. Make sure `VITE_API_BASE_URL` key in `backend/.env` is set to your Laravel API host (Default: http://localhost:8000)
5. Run `npm run dev`
6. Open Vue.js Admin Panel in browser and login with
    ```
    admin@example.com
    admin123
    ```
