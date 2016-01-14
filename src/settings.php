<?php
return [
    'settings' => [
        'displayErrorDetails' => true,

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Twig settings
        'twig' => [
            'template_path' => __DIR__ . '/../templates/',
            'cache_path' => __DIR__ . '/../cache/',
        ],

        'doctrine' => [
            'connection' => [
                'driver' => 'pdo_mysql',
                'user'     => 'root',
                'password' => 'password',
                'dbname'   => 'dbphp',
                'host'      => 'mysqlphp',
            ],
            'annotation_paths' => [__DIR__ . '/Fanta/Entities'],
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
        ],
    ],
];
