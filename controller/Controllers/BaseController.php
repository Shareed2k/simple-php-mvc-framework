<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 4/28/14
 * Time: 7:34 PM
 */

namespace Controllers;

use View\BaseView;

abstract class BaseController {
    protected $model;
    protected $view;

    function __construct(){
        $this->view = new BaseView();
    }

    abstract function indexAction();
} 