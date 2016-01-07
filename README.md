# Laravel 5 - Midlog
Laravel middleware package for logging HTTP requests and responses

Installation
-------------

Add Midlog as a requirement to composer.json:
```
{
  ...
  "require": {
    ...
    "vini/midlog": "dev-master"
    ...
  },
}
```

Update composer:
```
    composer update
```

Add the provider to your config/app.php:
```
  'providers' => [
  
    ...
    
    vini\midlog\MidlogServiceProvider::class,
    
  ],
```

Publish package config:
```
  php artisan vendor:publish
```
