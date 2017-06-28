<?php
/**
 * Created by PhpStorm.
 * User: al
 * Date: 06-27-17
 * Time: 02:45 AM
 */

namespace App;


class View
{
    function show($view, $data = []){
        extract($data);
        $display = include_once('../views/'.$view);
        return $display;
    }

}