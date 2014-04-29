<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 4/27/14
 * Time: 9:27 PM
 */

namespace Shareed2k;


class Route {

    /**
     * URL of this Route
     * @var string
     */
    private $_url;

    /**
     * Accepted HTTP methods for this route
     * @var array
     */
    private $_methods = array('GET', 'POST', 'PUT', 'DELETE');

    /**
     * Controller name
     * @var string
     */
    private $_controller;
    /**
     * Action name
     * @var string
     */
    private $_action;

    /**
     * Custom parameter filters for this route
     * @var array
     */
    private $_filters = array();

    /**
     * Array containing parameters passed through request URL
     * @var array
     */
    private $_parameters = array();

    /**
     * @param $resource
     * @param array $config
     */
    public function __construct($resource, array $config){
        $this->_url = $resource;
        $this->_config = $config;
        $this->_methods = isset($config['methods']) ? $config['methods'] : array();
        $this->_action = isset($config['action']) ? $config['action'] : '';
        $this->_controller = isset($config['controller']) ? $config['controller'] : '';
    }

    public function getUrl(){
        return $this->_url;
    }

    public function getController(){
        return $this->_controller;
    }

    public function getAction(){
        return $this->_action;
    }

    public function getMethods(){
        return $this->_methods;
    }

    public function setFilters(array $filters){
        $this->_filters = $filters;
    }

    public function getRegex(){
        return preg_replace_callback("/:(\w+)/", array(&$this, 'substituteFilter'), $this->_url);
    }

    private function substituteFilter($matches){
        if (isset($matches[1]) && isset($this->_filters[$matches[1]])) {
            return $this->_filters[$matches[1]];
        }

        return "([\w-]+)";
    }

    public function getParameters(){
        return $this->_parameters;
    }

    public function setParameters(array $parameters){
        $this->_parameters = $parameters;
    }
}