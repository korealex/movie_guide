<?php namespace App\Http;

/**
 * Created by PhpStorm.
 * User: al
 * Date: 06-26-17
 * Time: 11:55 PM
 */
class Request
{
    protected $input;
    protected $method;
    public $uri;

    function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        if($this->method == "GET"){
            $this->input= $_GET;
        }elseif ($this->method == "POST"){
            $this->input= $_POST;
        }
        $this->uri = $this->getCurrentUri();
    }

    public function get($key){
        return $this->input[$key];
    }
    public function has($key){
        return (isset($this->input[$key]) && !empty($this->input[$key]));
    }
    public function all(){
        return $this->input;
    }

    private function getCurrentUri()
    {
        $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
        if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
        $uri = '/' . trim($uri, '/');
        return $uri;
    }

}