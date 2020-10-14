# W.I.P.

## Introduction

Fortify Bootstrap is a combination of [Laravel Fortify](https://github.com/laravel/fortify) and [Bootstrap 4](https://getbootstrap.com). 

## Installation


Install the package via Composer.

```
composer require akukoder/fortify-bootstrap
```

Run the command to publish related files including Fortify files. 

```
php artisan ftbs:install
```

You can add ```--force``` option to overwrite existing files if necessary.

```
php artisan ftbs:install --force
```

Make sure ```FortifyServiceProvider``` is registered within the ```providers``` array of your ```app``` configuration file.

```
'providers' => [
    ....
    ....
    App\Providers\FortifyServiceProvider::class,
],    
```

## Credits
- [Laravel Fortify](https://github,com/laravel/fortify)
- [Bootstrap 4](https://getbootstrap.com)


## License

Fortify Boostrap is open-sourced software licensed under the [MIT license](LICENSE.md).
