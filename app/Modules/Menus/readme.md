# Menus : Laravel 5.1.x


## Status / Version

Beta Development


## Description

This module provides a way to display menus or navigational methods in your application.
the display methods are based on vespakoen's menu package.

## Functionality


### Menus
Define areas that your links will be displayed


### MenuLinks
Add links to the displayed menu areas


## Routes

* /admin/menus
* /admin/menulinks/{id}


## Install

### migration commands

```
php artisan module:migrate Menus
php artisan module:seed Menus
```


### publish commands

General Publish "ALL" method
```
php artisan vendor:publish --provider="App\Modules\Menus\Providers\MenusServiceProvider"
```

Specific Publish tags
```
php artisan vendor:publish --provider="App\Modules\Menus\Providers\MenusServiceProvider" --tag="configs"
php artisan vendor:publish --provider="App\Modules\Menus\Providers\MenusServiceProvider" --tag="images"
php artisan vendor:publish --provider="App\Modules\Menus\Providers\MenusServiceProvider" --tag="views"
```




## Packages

Intended to be used with:
https://github.com/illuminate3/rakkoII

The Following are packages that are specific to this module:

* https://github.com/etrepat/baum
* https://github.com/vespakoen/menu


## Screen Shots
## Thanks

Originally, I intended to use:
* https://github.com/TypiCMS/Menulinks

But my curiosity led me to develop my own module.
