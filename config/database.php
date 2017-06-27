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
//            'host' => getenv('DB_HOST', 'localhost'),
//            'database' => getenv('DATABASE','movies'),
//            'username' => getenv('USERNAME','admin'),
//            'password' => getenv('PASSWORD','password'),
            'host' => 'localhost',
            'database' => 'movies',
            'username' => 'admin',
            'password' => 'password',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => false
        ]
    ]
];

