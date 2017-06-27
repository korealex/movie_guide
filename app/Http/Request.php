<?php

/**
 * Created by PhpStorm.
 * User: al
 * Date: 06-26-17
 * Time: 11:55 PM
 */
class Request
{
    protected $input;

    function __construct($data)
    {
        $this->input=$data;
    }

    public function get($key){
        return $this->input[$key];
    }
    public function all(){
        return $this->input;
    }

}