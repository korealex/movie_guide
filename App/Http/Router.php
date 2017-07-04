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
    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($uri,\Closure $closure){
       $this->routes[$uri] = $closure;
    }

    public function run(){
        if (array_key_exists($this->request->uri,$this->routes)){
            return  $this->routes[$this->request->uri]();
        }else{
            throw new \Exception('Http url not found');
        }
    }
}