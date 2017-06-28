<?php
function dd($var){
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}
function base_path($file = ""){
    return __DIR__.'/'.$file;
}

function public_path($file = ""){
    return __DIR__.'/public/'.$file;
}

function env($key){
    $env =  include_once('.env');

}