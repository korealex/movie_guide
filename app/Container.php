<?php namespace App;

/**
 * Created by PhpStorm.
 * User: al
 * Date: 06-26-17
 * Time: 10:42 PM
 */
class Container
{
    protected $db_config;
    protected $request;


    function __construct()
    {
        $this->db_config = require('../config/database.php');
    }

    public function getConfig($name){
        $this->db_config[$name];
    }


}