<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 5/8/14
 * Time: 7:29 PM
 */

namespace Shareed2k;


class Sanitize {
    public static function escape($string){
        return htmlentities($string, ENT_QUOTES, 'UTF-8');
    }
} 