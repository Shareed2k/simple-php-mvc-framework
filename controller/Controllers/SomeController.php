<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 4/27/14
 * Time: 9:45 PM
 */
namespace Controllers;

use Model\indexModel;

class SomeController extends BaseController {

    public function __construct(){
        parent::__construct();
        $this->model = new indexModel();
    }

    public function indexAction(){

        $this->view->render('indexView', array('posts' => $this->model->getPosts()));
    }

    public function contactAction(){
        echo "contactAction";
    }

    public function errorAction($a, $b){
        echo "sorry 404 error\n";
        echo $a,$b;
    }
}