<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## This project 

This web application is created for the management of a small company. 
It helps to: 

- Creating and managing simple and totally customizable bill with a Word template.
- Creating QRBill in a separate pdf file.
- Managing client and supplier.
- Managing product and storage.
- View statistics (beta).

## Prerequisites 

- Composer
- MySQL >= 5.7

## Server Requirement 

- PHP >= 8.0
- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## How to install

Download the repository into your folder, open the folder and run:

    composer install

**create** a database, rename the file **.env.example** to **.env** and change it to your need, then run:

    php artisan migrate

and 

    php artisan key:generate

Now you can open the application by typing 

    php artisan serve

or browsing from your personal web server root.

    
