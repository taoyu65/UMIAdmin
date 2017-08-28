# Laravel PHP Framework
中文介绍(https://github.com/taoyu65/UMIAdmin/blob/master/readme_cn.md)
#
[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Umi admin is powerful backend management system, including

- BREAD system (Browse, Read, Edit, Add, & Delete), made for Laravel 5.3.
- RBAC system (role and permission control) including 2 parts, table of database (combine with BREAD) and web page url control
- data table search function with customized searching option
- customized relation of table for table's delete or update
- display any foreign key to any format you want to show on the web page (like foreign key to drop down list or text box or pop up a window to show)

## installation
1. install composer and laravel 5.3 Please install correctly. recommends use the follow command 
> composer create-project --prefer-dist laravel/laravel blog 5.3.*
2. install UMI Admin. 
>composer require ym/umi v0.1.2.* <br>
>If not prefer to use composer to install, please read https://github.com/taoyu65/UMIAdmin/wiki/install_en
3. config (.env)
>DB_HOST=localhost<br>
>DB_DATABASE=new a null database<br>
>DB_USERNAME=user name<br>
>DB_PASSWORD=password<br>
4. add server provider to "config/app.php"
>YM\UmiServiceProvider::class,<br>
>YM\umiAuth\umiAuthServiceProvider::class,
5. run command to install application and config file
>php artisan umi:install (option for choosing language 1=chinese 2=english) input number then press enter.
>(warning:if need to change language for database after installation only run command php artisan umi:install --lang-zh-only / --lang-en-only) 
6. setting language:
>in the file config/app.php, 'locale' => 'zh_cn' or 'en'
7. ok, let's start.<br>
warning: Please keep the new database is empty before install application, or empty database before run the installation command

## 图片 
![](http://umi.laravelumi.com/public/img/img/a.jpg)
![](http://umi.laravelumi.com/public/img/img/b.jpg)
![](http://umi.laravelumi.com/public/img/img/c.jpg)
![](http://umi.laravelumi.com/public/img/img/d.jpg)
![](http://umi.laravelumi.com/public/img/img/e.jpg)
![](http://umi.laravelumi.com/public/img/img/f.jpg)
![](http://umi.laravelumi.com/public/img/img/g.jpg)
![](http://umi.laravelumi.com/public/img/img/h.jpg)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).