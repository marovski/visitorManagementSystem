<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Guests and Visitors

Using laravel as our framework this app manages to be a strong and robust software.
Our application purpose is to controll all the guests and visitors in a company, tracking their data and time spent, for better workflow and management. This app also controlls the deliveries and the drops made by external individuals and track the lost and found items inside the facility. 

## MVC architecture

The software architectural pattern was MVC in which the application logic is divided into three components on the basis of functionality.

* Models — represent how data is stored in the database.
* Views — the components that are visible to the user, such as an output or a GUI.
* Controllers — the components that act as an interface between models and views.

## Install

Download and execute the command to create the database 
```
php artisan mysql:createdb nanium

```
Execute the command to do the migration
```
php artisan migrate
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
