<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 5/8/14
 * Time: 6:58 PM
 */

namespace Shareed2k;


class Session {

    public static function exists($name){
        return (isset($_SESSION[$name])) ? true : false;
    }

    public static function put($name, $value){
        return $_SESSION[$name] = $value;
    }

    public static function get($name){
        return $_SESSION[$name];
    }

    public static function delete($name){
        if(self::exists($name)){
            unset($_SESSION[$name]);
        }
    }

    public static function flash($name, $string = ''){
        if(self::exists($name)){
            $session = self::get($name);
            self::delete($name);
            return $session;
        }else{
            self::put($name, $string);
        }
    }
} 