<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 4/27/14
 * Time: 7:46 PM
 */

namespace Shareed2k;


class DataBase {
    private $_db_host = DB_HOST;
    private $_db_name = DB_NAME;
    private $_db_user = DB_USER;
    private $_db_pass = DB_PASS;

    private $_db_obj = null;
    private $_db_driver_opt = array();

    public $_last_statement;
    public $_affected_rows;
    public $_id;

    public function __construct($dbconn = null){
        $this->setProperties($dbconn);
        $this->connect();
    }

    public function setProperties($array = null){
        if(!empty($array) && is_array($array) && count($array) == 4){
            foreach($array as $key => $value){
                $this->$key = $value;
            }
        }
    }

    public function connect(){
        $this->setDriverOptions(array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        ));

        try{
            $this->_db_obj = new \PDO(
                 "mysql:dbname={$this->_db_name};host={$this->_db_host}",
                $this->_db_user,
                $this->_db_pass,
                $this->_db_driver_opt
            );
        }catch(\PDOException $e){
            echo $e->getMessage();
            exit;
        }
    }

    public function setDriverOptions($opt = null){
        if(!empty($opt)){
            $this->_db_driver_opt = $opt;
        }
    }

    private function query($sql = null, $params = null){
        if(!empty($sql)){
            $this->_last_statement = $sql;

            if($this->_db_obj == null){
                $this->connect();
            }

            try{
                $statment = $this->_db_obj->prepare($sql, $this->_db_driver_opt);

                $params = Helper::makeArray($params);

                if(!$statment->execute($params) || $statment->errorCode() != '0000'){
                    $error = $statment->errorInfo();
                    throw new \PDOException("Database error {$error[0]} : {$error[2]}, driver error code is {$error[1]}");
                    exit;
                }

                return $statment;

            }catch (\PDOException $e){
                echo $this->formatException($e);
                exit;
            }
        }
    }

    public function formatException($exception = null){
        if(is_object($exception)){
            $out = array();
            $out[] = '<strong>Message:</strong>'.$exception->getMessage();
            $out[] = '<strong>Code:</strong>'.$exception->getCode();
            $out[] = '<strong>File:</strong>'.$exception->getFile();
            $out[] = '<strong>Line:</strong>'.$exception->getLine();
            $out[] = '<strong>Trace:</strong>'.$exception->getTraceAsString();
            $out[] = '<strong>Last statement:</strong>'.$this->_last_statement;
            return '<p>'.implode('<br />', $out).'</p>';
        }
    }

    public function getLastInsertedId($sequenceName = null){
        return $this->_db_obj->lastInsertedId($sequenceName);
    }


    public function getAll($sql = null, $params = null){
        if(!empty($sql)){
            $statment = $this->query($sql, $params);
            return $statment->fetchAll(\PDO::FETCH_ASSOC);
        }
    }

    public function getOne($sql = null, $params = null){
        if(!empty($sql)){
            $statment = $this->query($sql, $params);
            return $statment->fetch(\PDO::FETCH_ASSOC);
        }
    }

    public function execute($sql = null, $params = null){
        if(!empty($sql)){
            $statment = $this->query($sql, $params);
            $this->_affected_rows = $statment->rowCount();
            return true;
        }
        return false;
    }

    public function insert($sql = null, $params = null){
        if(!empty($sql)){
            if($this->execute($sql, $params)){
                $this->_id = $this->getLastInsertedId();
                return true;
            }
            return false;
        }
        return false;
    }
} 