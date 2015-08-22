# Slim 3 Skeleton

This is a simple skeleton project for Slim 3 that includes Twig, Flash messages and Monolog.

**Important**: this is a fork of [akrabat's slim 3 skeleton](https://github.com/akrabat/slim3-skeleton),
this fork uses [king23/di-interop](https://github.com/ppetermann/king23-di) instead of pimple.

You can read more about this fork in the [blog post that caused it](https://devedge.wordpress.com/2015/08/22/slim-framework-3-king23di-replacing-pimple/)

## Create your project:

    $ composer create-project -n -s dev ppetermann/slim3-skeleton my-app

### Run it:

1. `$ cd my-app`
2. `$ php -S 0.0.0.0:8888 -t public public/index.php`
3. Browse to http://localhost:8888

## Key directories

* `app`: Application code
* `app/src`: All class files within the `App` namespace
* `app/templates`: Twig template files
* `cache/twig`: Twig's Autocreated cache files
* `log`: Log files
* `public`: Webserver root
* `vendor`: Composer dependencies

## Key files

* `public/index.php`: Entry point to application
* `app/container.php`: instantiation of the containe + slim-default-dependencies
* `app/settings.php`: Configuration
* `app/dependencies.php`: Services for king23/di
* `app/middleware.php`: Application middleware
* `app/routes.php`: All application routes are here
* `app/src/Action/HomeAction.php`: Action class for the home page
* `app/templates/home.twig`: Twig template file for the home page
