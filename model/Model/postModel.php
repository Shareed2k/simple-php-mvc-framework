<?php

namespace Model;

use Shareed2k\DataBase;

class postModel extends BaseModel{

    private $_db;

    public function __construct(){
        $this->_db = new DataBase();
    }

    public function getPost($id){
        if(!empty($id)){
            $sql = "SELECT * FROM posts WHERE id = ?";
            return $this->_db->getOne($sql, $id);
        }

    }

    public function addComment($params){
        if(!empty($params)){
            $sql = "INSERT INTO comments (`author`, `text`, `post_id`) VALUES (?,?,?)";
            if(!$this->_db->insert($sql, $params)){
                echo "error to add new comment";
            }
        }
    }
}