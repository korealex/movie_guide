<?php namespace App\Http;

/**
 * Created by PhpStorm.
 * User: al
 * Date: 06-26-17
 * Time: 11:49 PM
 */
class Router
{

    protected $request;
    protected $routes=[];
    function __construct()
    {
        $this->request = new Request();

    }

    public function get($uri,$closure){
       $this->routes[$uri] = $closure;
    }

    public function run(){
        return $this->routes[$this->request->uri]();
    }








}