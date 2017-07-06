<?php namespace App\Http;

/**
 * Created by PhpStorm.
 * User: al
 * Date: 06-26-17
 * Time: 11:49 PM
 */
class Router
{

    /**
     * @var Request
     */
    protected $request;
    /**
     * @var array
     */
    protected $routes=[];

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($uri,\Closure $closure){
        array_push($this->routes, ['uri'=>$uri,'method'=>'GET','callback'=>$closure]);
    }
    public function post($uri,\Closure $closure){
        array_push($this->routes,['uri'=>$uri,'method'=>'POST','callback'=>$closure]);
    }

    public function run(){

        foreach ($this->routes as $route){
            if($this->request->uri == $route['uri'] && $this->request->method == $route['method']){
                return $route['callback']();
            }

        }
        return header("Location: http://" . $_SERVER['HTTP_HOST']);
        exit;
        new \Exception('Http url not found');

    }
}