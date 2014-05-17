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

        $jo = "test";
        $this->view->render('indexView', array('jopa' => serialize($jo), 'posts' => $this->model->getPosts()));
    }


    public function loginAction(){

        $this->view->render('loginView');
    }

    public function dologinAction(){
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        if(isset($_POST)){
            $userArr = $this->model->login($user, $pass);
            if(!empty($userArr)){

                $_SESSION["user"] = $userArr['name'];
                $_SESSION["perm"] = $userArr['perm'];

                var_dump($_SESSION);
            }else{
                echo "no user exist";
                //header("Location: ./");
            }
        }
    }

    public function errorAction($a, $b){
        echo "sorry 404 error\n";
        echo $a,$b;
    }
}