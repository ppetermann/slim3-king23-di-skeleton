<?php
/**
 * this file contains the defaults that slim requires a DI container to provide
 * as long as you don't want to change those defaults, you shouldn't need to touch this.
 */
$container = new \King23\DI\Interop\InteropContainer();

$container->register(
    'settings',
    function () {
        $default = [
            'cookieLifetime' => '20 minutes',
            'cookiePath' => '/',
            'cookieDomain' => null,
            'cookieSecure' => false,
            'cookieHttpOnly' => false,
            'httpVersion' => '1.1',
            'responseChunkSize' => 4096,
            'outputBuffering' => 'append',
            'determineRouteBeforeAppMiddleware' => false
        ];

        $settings = require 'settings.php';

        return array_merge($default, $settings);
    }
);
$container->register(
    'environment',
    function () {
        return new \Slim\Http\Environment($_SERVER);
    }
);

$container->registerFactory('response',
    function () use ($container) {
        $headers = new \Slim\Http\Headers(['Content-Type' => 'text/html']);
        $response = new \Slim\Http\Response(200, $headers);
        return $response->withProtocolVersion($container->get('settings')['httpVersion']);
    }
);

$container->registerFactory(
    'request',
    function () use ($container) {
        return \Slim\Http\Request::createFromEnvironment($container->get('environment'));
    }
);
$container->register(
    'router',
    function () {
        return new \Slim\Router();
    }
);
$container->register(
    'errorHandler',
    function () {
        return new \Slim\Handlers\Error();
    }
);
$container->register(
    'notAllowedHandler',
    function () {
        return new \Slim\Handlers\NotAllowed();
    }
);

$container->register(
    'notFoundHandler',
    function () {
        return new \Slim\Handlers\NotFound();
    }
);

$container->register(
    'foundHandler',
    function() {
        return new \Slim\Handlers\Strategies\RequestResponse();
    }
);

$container->registerFactory(
    'callableResolver',
    function () use ($container) {
        return new \Slim\CallableResolver($container);
    }
);

return $container;
