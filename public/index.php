<?php
session_start();
require ('../autoloader.php');
require('../App/Container.php');
require ('../helpers.php');

    $app = new \App\Container();

    $app->getConnection('mysql');
    $app->getRequest();
    $app->getQueryBuilder()->where();
    $app->getView()->show('layout/main.php',['hello'=>"name "]);

