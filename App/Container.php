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
        /**
         * the request grabs data requested to the server and provides
         * methods for handling it.
         *
         */
        $this->request = new Request();
        /**
         * the view class is responsible for  dispatching the view elements
         * and integrating it with the system data
         */
        $this->view = new View();
        /**
         * the router identifies the user intention to access a uri and integrates  the request and the view to
         * respond using a closure or a controller
         */
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