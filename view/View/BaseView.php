<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 4/28/14
 * Time: 7:47 PM
 */

namespace View;


class BaseView {

    function render($template_view, $data = null)
    {

        if(is_array($data)) {
            extract($data);
        }
        include_once 'view/header.html';

        if(file_exists('public/views/'.$template_view.'.php')){
            include_once 'public/views/'.$template_view.'.php';
        }else{
            echo "<p>can't find view file</p>";
        }

        include_once 'view/footer.html';
    }
} 