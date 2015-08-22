<?php
/** @var King23\DI\Interop\InteropContainer $container */
$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

$container->register(\Slim\Views\Twig::class, function () use ($container) {

    $view = new \Slim\Views\Twig(
        $container->get('settings')['view']['template_path'],
        $container->get('settings')['view']['twig']
    );

    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($container->get('router'), $container->get('request')->getUri()));
    $view->addExtension(new Twig_Extension_Debug());

    return $view;
});

$container->register('flash', function () use($container){
    return new \Slim\Flash\Messages();
});


// -----------------------------------------------------------------------------
// Service factories
// -----------------------------------------------------------------------------

$container->register(\Psr\Log\LoggerInterface::class, function () use ($container){
    $settings = $container->get('settings')['logger'];
    $logger = new \Monolog\Logger($settings['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], \Monolog\Logger::DEBUG));
    return $logger;
});
