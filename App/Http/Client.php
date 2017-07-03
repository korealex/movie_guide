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

    function get($url, $header = null, $return_code = false){
        $request = curl_init($url);

        if(!empty($header)){
            curl_setopt($request, CURLOPT_HTTPHEADER,$header);
        }
        curl_setopt($request,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($request, CURLINFO_HEADER_OUT, true);
        $response = curl_exec($request);
        $http_code = curl_getinfo($request, CURLINFO_HTTP_CODE);
        $info = curl_getinfo($request,CURLINFO_HEADER_OUT);

        curl_close($request);
        if($return_code){
            return $http_code;
        }
        return json_decode($response,true);

    }

}