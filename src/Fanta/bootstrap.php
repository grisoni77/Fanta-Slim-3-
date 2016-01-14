<?php

$container = $app->getContainer();


// Fanta admin routes
require __DIR__ . '/routes/admin.php';
require __DIR__ . '/routes/front.php';

$container ['auth'] = function($c) {
    return new \Fanta\Service\Auth($c);
};

$container ['session'] = function() {
    return new \Fanta\Service\Session();
};
$container['twig']->offsetSet('session', $container['session']->get());