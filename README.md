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

1. Download the project (or clone using GIT)
2. Copy `.env.example` into `.env` and configure database credentials
3. Navigate to the project's root directory using terminal
4. Run `composer install`
5. Set the encryption key by executing `php artisan key:generate --ansi`
6. Run migrations `php artisan migrate`
7. Start local server by executing `php artisan serve`
