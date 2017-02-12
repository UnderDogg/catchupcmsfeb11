# Kagi (Authentification / Authorization) : Laravel 5.1.x Beta Development


## Status / Version

Beta Development


## Description

This module is to solve Authentification / Authorization for users.
This module does not management User information.


## Functionality


### Permissions
Permission Mangment


### Roles
Role Management


### Users
An extension of the very basic User Model that is provided with the Rakko Platform.


## Routes

* /admin/permissions
* /admin/roles
* /admin/users


* auth/login
* social/login


## Install

### .env file
```
GITHUB_CLIENT_ID=
GITHUB_CLIENT_SECRET=
GITHUB_REDIRECT=http://www.site.com/social/login

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT=http://www.site.com/social/login
```

### publish commands

General Publish "ALL" method
```
php artisan vendor:publish --provider="App\Modules\Kagi\Providers\KagiServiceProvider"
```

Specific Publish tags
```
php artisan vendor:publish --provider="App\Modules\Kagi\Providers\KagiServiceProvider" --tag="configs"
php artisan vendor:publish --provider="App\Modules\Kagi\Providers\KagiServiceProvider" --tag="images"
php artisan vendor:publish --provider="App\Modules\Kagi\Providers\KagiServiceProvider" --tag="vendors"
php artisan vendor:publish --provider="App\Modules\Kagi\Providers\KagiServiceProvider" --tag="views"
```


## Email Testing
http://mailcatcher.me/ was used to test email on localhost


## Packages

Intended to be used with:

* https://github.com/illuminate3/rakkoII
* https://github.com/illuminate3/profiles

The Following are packages that are specific to this module:

* https://github.com/caffeinated/shinobi
* https://github.com/laravel/socialite


## Screen Shots
## Thanks
