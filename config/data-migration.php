<?php

// config for MuhammadAbdElHay/DataMigration
return [
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'url' => env('SECOND_DB_URL'),
            'host' => env('SECOND_DB_HOST', '127.0.0.1'),
            'port' => env('SECOND_DB_PORT', '3306'),
            'database' => env('SECOND_DB_DATABASE', ''),
            'username' => env('SECOND_DB_USERNAME', ''),
            'password' => env('SECOND_DB_PASSWORD', ''),
            'unix_socket' => env('SECOND_DB_SOCKET', ''),
            'charset' => env('SECOND_DB_CHARSET', 'utf8mb4'),
            'collation' => env('SECOND_DB_COLLATION', 'utf8mb4_unicode_ci'),
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
    ],

];
