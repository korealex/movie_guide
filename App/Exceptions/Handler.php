<?php namespace App\Exceptions;

/**
 * Created by PhpStorm.
 * User: al
 * Date: 06-26-17
 * Time: 11:50 PM
 */
class Handler
{
    protected $exception;
    function __construct(\Exception $exception)
    {
        $this->exception = $exception;
    }

    function render(){
        echo $this->exception->getMessage();
        return;
    }

}