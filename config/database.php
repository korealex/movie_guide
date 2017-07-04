<?php
/**
 * Created by PhpStorm.
 * User: al
 * Date: 06-26-17
 * Time: 11:17 PM
 */

return[
    'default' => 'mysql',
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => getenv('DB_HOST'),
            'database' => getenv('DB_NAME'),
            'username' => getenv('DB_USER'),
            'password' => getenv('DB_PASS'),
            'port' => getenv('DB_PORT'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => false
        ]
    ]
];

