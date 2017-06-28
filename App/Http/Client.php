<?php namespace App\Http;
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 06-28-17
 * Time: 02:39 PM
 */

namespace App\Http;


class Client
{

    function get($url, $header){
        $request = curl_init($url);

        curl_setopt($request, CURLOPT_HTTPHEADER,$header);
        curl_setopt($request,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($request, CURLINFO_HEADER_OUT, true);
        $response = curl_exec($request);
        //$info = curl_getinfo($request,CURLINFO_HEADER_OUT);
        curl_close($request);
        return json_decode($response,true);

    }

}