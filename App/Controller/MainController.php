<?php namespace App\Controller;

use App\Container;

/**
 * Created by PhpStorm.
 * User: al
 * Date: 06-26-17
 * Time: 10:42 PM
 */
class MainController
{
    protected $app;
    protected $request;
    function __construct(Container $app)
    {
        $this->app = $app;
    }


}