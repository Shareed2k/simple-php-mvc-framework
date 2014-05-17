<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 5/8/14
 * Time: 9:20 AM
 */

namespace Shareed2k;

use Shareed2k\DataBase;

class Validate {
    private $_passed = false;
    private $_errors = array();
    private $_db = null;

    public function __construct(){
        $this->_db = new DataBase();
    }

    public function check($source, $items = array()){
        foreach($items as $item => $rules){
            foreach($rules as $rule => $rule_value){
                //echo "{$item} {$rule} must be {$rule_value}<br>";
                $value = $source[$item];
                //echo $value;

                if($rule === 'required' && empty($value)){
                    $this->addError("{$item} is require.");
                }else{
                    switch($rule){
                        case 'min':
                            if(strlen($value) < $rule_value){
                                $this->addError("{$item} must be a minimum of {$rule_value} characters.");
                            }
                            break;
                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->addError("{$item} must be a maximum of {$rule_value} characters.");
                            }
                            break;
                        case 'matches':
                            if($value != $source[$rule_value]){
                                $this->addError("{$rule_value} must match {$item}.");
                            }
                            break;
                        case 'unique':
                            $sql = "SELECT {$item} FROM {$rule_value} WHERE {$item} = ? LIMIT 1";
                            $this->_db->getOne($sql, $value);
                            if($this->_db->getRowCount()){
                                $this->addError("{$item} already exists.");
                            }
                            break;
                        case 'integer':
                            if(!ctype_digit($value)){
                                $this->addError("{$item} is not integer.");
                            }
                            break;
                    }
                }
            }
        }

        if(empty($this->_errors)){
            $this->_passed = true;
        }

        return $this;
    }

    private function addError($error){
        $this->_errors[] = $error;
    }

    public function errors(){
        return $this->_errors;
    }

    public function passed(){
        return $this->_passed;
    }
} 