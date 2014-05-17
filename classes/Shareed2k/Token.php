<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 5/8/14
 * Time: 6:01 PM
 */

namespace Shareed2k;


class Token {

    public static function generate(){
        return $_SESSION['token'] = md5(uniqid());
    }

    public static function check($token){
        $tokenName = $_SESSION['token'];

        if(isset($_SESSION['token']) && $token === $tokenName){
            unset($_SESSION['token']);
            return true;
        }
        return false;
    }
} 