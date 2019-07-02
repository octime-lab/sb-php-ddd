<?php

$dotenv = new Symfony\Component\Dotenv\Dotenv();
$dotenv->load('.env');

return [
    'paths' => [
        'migrations' => 'config/migrations',
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'develop' => [
            'adapter' => getenv('DB_DRIVER'),
            'host' => getenv('DB_HOST'),
            'name' => getenv('DB_NAME'),
            'user' => getenv('DB_USER'),
            'pass' => getenv('DB_PASSWORD'),
            'port' => getenv('DB_PORT'),
        ],
    ],
];
