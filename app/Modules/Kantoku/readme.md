# Kantoku (Module Manager) : Laravel 5.1.x


## Status / Version

Beta Development


## Description
Kantoku extends the ability of the Rakko platform's by providing it with a module manager.


## Functionality


### Modules
Manage Modules


## Routes

* /admin/modules


## Install

### migration commands

```
php artisan module:migrate Kantoku
php artisan module:seed Kantoku
```


### publish commands

General Publish "ALL" method
```
php artisan vendor:publish --provider="App\Modules\Kantoku\Providers\KantokuServiceProvider"
```

Specific Publish tags
```
php artisan vendor:publish --provider="App\Modules\Kantoku\Providers\KantokuServiceProvider" --tag="configs"
php artisan vendor:publish --provider="App\Modules\Kantoku\Providers\KantokuServiceProvider" --tag="images"
php artisan vendor:publish --provider="App\Modules\Kantoku\Providers\KantokuServiceProvider" --tag="views"
```


## Packages

Intended to be used with:
https://github.com/illuminate3/rakkoII


## Screen Shots
## Thanks
