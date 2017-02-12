# Profiles : Laravel 5.1.x


## Status / Version

Beta Development


## Description



## Functionality


### Profiles
Supplements the main Rakko app's locale functionality.
Ability to control Locales through the database.


## Routes

* /profiles


## Install

### migration commands

```
php artisan module:migrate Profiles
php artisan module:seed Profiles
```


### publish commands

General Publish "ALL" method
```
php artisan vendor:publish --provider="App\Modules\Profiles\Providers\ProfilesServiceProvider"
```

Specific Publish tags
```
php artisan vendor:publish --provider="App\Modules\Profiles\Providers\ProfilesServiceProvider" --tag="configs"
php artisan vendor:publish --provider="App\Modules\Profiles\Providers\ProfilesServiceProvider" --tag="images"
php artisan vendor:publish --provider="App\Modules\Profiles\Providers\ProfilesServiceProvider" --tag="views"
```


## Packages

Intended to be used with:
https://github.com/illuminate3/rakkoII


## Screen Shots
## Thanks
