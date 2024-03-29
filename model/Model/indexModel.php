<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 4/28/14
 * Time: 10:11 PM
 */

namespace Model;

use Shareed2k\DataBase;

class indexModel extends BaseModel{

    private $_db;

    public function __construct(){
        $this->_db = new DataBase();
    }

    public function getPosts(){
        $sql = "SELECT * FROM posts";
        return $this->_db->getAll($sql);
    }

    public function login($user, $pass){
        $sql = "SELECT name, perm FROM users WHERE name = ? and pass = ?";
        return $this->_db->getOne($sql, array($user, $pass));
    }
} 