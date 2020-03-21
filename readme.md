#RecipeBook on Laravel

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About RecipeBook

RecipeBook is a simple web application built on top of the best Artisan framework: Laravel.
The purpose of RecipeBook web application is to keep your recipes anywhere you go, anywhere there is a connection. 

You don't have to be worried about your recipes anymore. Just jot it down, and forget about it until then you wanna
 cook it. 
 

## Requirements

Since RecipeBook is built on top of Laravel, the requirements are the same with those [Laravel required](https://laravel.com/docs/7.x#server-requirements).

For the database, You can use any database that laravel Eloquent support. Just be sure you have the database setup before you run the migration.
 
 If you want to run the server on your local development machine, please have composer installed properly.
 
## Installation
To run this project on your local machine, please clone the project.

- Clone this project
- go to the folder where you clone it
- Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
- Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and
 password (DB_PASSWORD) field correspond to your configuration. By default, the username is root and you can leave the password field empty. (This is for Xampp) By default, the username is root and password is also root. (This is for Lamp)
- Run php artisan key:generate
- Run php artisan migrate
- Run php artisan serve
- Go to localhost:8000

## Credits
- Thank you for Laravel framework! 
 [Laravel documentation](https://laravel.com/docs/contributions).
- Taylor Otwell for the simplicity yet thorough framework.
- Guys in TLab Yogyakarta for giving me the chance to this project.

## Notes
RecipeBook is a test case project I ([Gabriel](https://www.linkedin.com/in/gabrielfermy/)) create for my application
 as a Back End Developer in TLab YK. 
 
 This project is a barebone project. This is not intended to be in production before receiving
  ALOT enhancement in various aspect. Thus, please, be gentle with it. ^_^

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
