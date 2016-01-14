<?php

$container = $app->getContainer();

$container['AdminController'] = function($container) {
    return new \Fanta\Controller\Admin\Admin($container);
};

// Fanta admin routes
require __DIR__ . '/routes/admin.php';