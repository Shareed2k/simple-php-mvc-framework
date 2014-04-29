<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 4/27/14
 * Time: 7:30 PM
 */

namespace Shareed2k;


class Core {

    public static function run(Router $router){
        $route = $router->matchRequest();

        if($route) {
            //var_dump($route);
            $controller = '\Controllers\\'.$route->getController();
            $method = $route->getAction();
            if(class_exists($controller)){
                $obj = new $controller;
                if(method_exists($obj, $method)){
                    $params = $route->getParameters()?$route->getParameters():array();
                    call_user_func_array(array($obj, $method), $params);
                }
            }
        }else{
            $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
            header('HTTP/1.1 404 Not Found');
            header("Status: 404 Not Found");
            header('Location:'.$host.'404');
            exit;
        }
    }
} 