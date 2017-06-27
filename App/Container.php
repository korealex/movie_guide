<?php namespace App;

use App\Http\Request;
use App\Http\Router;
use App\Models\QueryBuilder;


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
    protected $builder;


    function __construct()
    {
        $this->db_config = require('../config/database.php');
        $this->request = new Request();
        $this->builder = new QueryBuilder($this->getConnection('mysql'));
        $this->view = new View();
    }

    public function getConnection($name){
        return $this->db_config['connections'][$name];
    }

    public function getRequest(){
        return $this->request;
    }

    public function getQueryBuilder(){
        return $this->builder;
    }

    public function getView(){
        return $this->view;
    }


}