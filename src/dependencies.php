<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
//$container['renderer'] = function ($c) {
//    $settings = $c->get('settings')['renderer'];
//    return new Slim\Views\PhpRenderer($settings['template_path']);
//};

// twig renderer
$container['twig'] = function ($container) {
    $settings = $container->get('settings')['twig'];
    $view = new \Slim\Views\Twig($settings['template_path'], [
        //'cache' => $settings['cache_path']
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));

    return $view;
};

// Register Entity Manager in the container
$container['entityManager'] = function ($c) {
    $doctrineSettings = $c->get('settings')['doctrine'];
    return \Jgut\Slim\Doctrine\EntityManagerBuilder::build($doctrineSettings);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

