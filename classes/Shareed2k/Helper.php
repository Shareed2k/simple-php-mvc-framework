<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 4/27/14
 * Time: 8:32 PM
 */

namespace Shareed2k;


class Helper {

    public static function makeArray($array = null){
        return is_array($array) ? $array : array($array);
    }
} 