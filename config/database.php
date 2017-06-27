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
            'host' => getenv('DB_HOST', 'localhost'),
            'database' => getenv('OAUTH_DATABASE'),
            'username' => getenv('OAUTH_USERNAME'),
            'password' => getenv('OAUTH_PASSWORD'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => false
        ]
    ]
];

