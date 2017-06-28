<?php
session_start();
require ('../env.php');
require ('../autoloader.php');
require('../App/Container.php');
require ('../helpers.php');

    $app = new \App\Container();

    $app->getConnection('mysql');
    $app->getRequest();
    $app->getQueryBuilder()->where();
    $app->getView()->show('template/search.php',['hello'=>"name "]);

