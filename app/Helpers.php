<?php

    function randomNumber($length = 19) {

      return substr_replace(str_shuffle(str_repeat($x = "1029384756", ceil($length / strlen($x)))), 1, $length);
    
    }

    function guzzle( $method, $url, $param = [] ){

        try{
             $client = new \GuzzleHttp\Client();
             $res = $client->request($method, $url, $param);
             return json_decode($res->getBody());   

        }catch(GuzzleHttp\Exception\ConnectException $e){

            
             Session::flash('custom_error', [
                 'data' => 'Connection Lost. Some data may not be appeared. <a href="#" onclick="window.location.reload()">[Refresh]</a> again'
             ]);
            


        }catch (GuzzleHttp\Exception\RequestException $e) {

           Session::flash('custom_error', [
                 'data' => 'Connection Lost. Some data may not be appeared. <a href="#" onclick="window.location.reload()">[Refresh]</a> again'
             ]);
             
        }

        return ['data' => 'CONN_ERR'];

    }

    function apiToken(){

        return bin2hex(openssl_random_pseudo_bytes(30));

    }

    function customToken($length = 32) {

        $x = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890";
        return substr(str_shuffle(str_repeat($x, ceil($length / strlen($x)))), 1, $length);

    }