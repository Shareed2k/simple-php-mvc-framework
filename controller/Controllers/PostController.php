<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 4/27/14
 * Time: 9:45 PM
 */
namespace Controllers;

use Model\postModel;
use Shareed2k\Sanitize;
use Shareed2k\Validate;
use Shareed2k\Token;
use Shareed2k\Session;

class PostController extends BaseController {

    private $_postId;

    public function __construct(){
        parent::__construct();
        $this->model = new postModel();
    }

    public function indexAction($id = null){

        if(!empty($id)){
            $this->_postId = (int)$id;
            $this->view->render('postView', array('posts' => $this->model->getPost((int)$id)));
        }

    }

    public function uploadAction(){
        header('Content-Type: application/json');

        $uploaded = array();
        $exts = array('jpg', 'gif', 'png');

        if(!empty($_FILES['file']['name'][0])){
            foreach($_FILES['file']['name'] as $position => $name){

                $file_ext = explode('.', $name);
                $file_ext = strtolower(end($file_ext));

                if(in_array($file_ext, $exts)){
                    $new_file = 'uploads/' . uniqid()."_".date('Y-m-d').".".$file_ext;
                    if(move_uploaded_file($_FILES['file']['tmp_name'][$position], $new_file)){
                        $uploaded[] = array(
                            'status' => true,
                            'type' => $_FILES['file']['type'][$position],
                            'name' => $name,
                            'file' => $new_file
                        );
                    }
                }else{
                    $uploaded[] = array(
                        'status' => false,
                        'type' => $_FILES['file']['type'][$position],
                        'name' => $name,
                        'error' => 'file extension '. $file_ext . ' not allowed.'
                    );
                }
            }
        }

        echo json_encode($uploaded);
    }

    public function addComment(){
        if(isset($_POST)){
            if(Token::check($_POST['token'])){
                $validate = new Validate();
                $validation = $validate->check($_POST, array(
                    'author' => array(
                        'required' => true,
                        'min' => 4,
                        'max' => 20,
                        'unique' => 'comments'
                    ),
                    'com_text' => array(
                        'required' => true,
                        'min' => 2,
                        'max' => 255
                    ),
                    'post_id' => array(
                        'required' => true,
                        'integer' => true
                    )
                ));

                $name = Sanitize::escape($_POST['author']);
                $text = Sanitize::escape($_POST['com_text']);
                $post_id = (int)$_POST['post_id'];

                if($validation->passed()){
                    $this->model->addComment(array($name, $text, $post_id));
                }else{
                    Session::flash("error", serialize($validation->errors()));
                    header('Location: http://localhost:8088/mvc_cms/post/id/1');
                }
            }else{
                echo "CSRF Protection<br>";
            }
        }
    }
}