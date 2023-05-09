<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

### Installation (the slow way) ###

* `git clone git clone https://github.com/bestmomo/laravel-example.git projectname` to clone the repository
* `cd projectname`
* `composer install`
* *.env.example* to *.env*
* `php artisan key:generate`to regenerate secure key
* edit *.env* for database configuration
    * set DB_CONNECTION
    * set DB_DATABASE
    * set DB_USERNAME
    * set DB_PASSWORD
* `php artisan migrate --seed` to create and populate tables
* `php artisan storage:link` To create the symbolic link
### Tricks ###

To use application the database is seeding with users :

* Administrator : email = admin@gmail.com, password = Admin@123
