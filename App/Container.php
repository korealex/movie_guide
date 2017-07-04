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
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var QueryBuilder
     */
    protected $builder;
    /**
     * @var Router
     */
    protected $routes;


    function __construct()
    {
        $this->request = new Request();
        $this->view = new View();
        $this->router = new Router($this->request);
    }

    public function connection($name){
        return $this->db_config['connections'][$name];
    }

    public function request(){
        return $this->request;
    }

    public function queryBuilder(){
        return $this->builder;
    }

    public function view(){
        return $this->view;
    }

    public function routes(){

        return $this->router;
    }


}