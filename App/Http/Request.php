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

    function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        if($this->method == "GET"){
            $this->input= $_GET;
        }elseif ($this->method == "POST"){
            $this->input= $_POST;
        }

    }

    public function get($key){
        return $this->input[$key];
    }
    public function all(){
        return $this->input;
    }

}