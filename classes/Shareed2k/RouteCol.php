<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 4/27/14
 * Time: 9:24 PM
 */

namespace Shareed2k;

use Iterator;

class RouteCol implements Iterator
{
    private $_routes = array();

    public function add($uri, Route $action)
    {
        $this->_routes[$uri] = $action;
    }

    public function remove($uri)
    {
        unset($this->_routes[$uri]);
    }

    public function get($uri)
    {
        return $this->_routes[$uri];
    }

    public function current()
    {
        return current($this->_routes);
    }

    public function next()
    {
        next($this->_routes);
    }

    public function all()
    {
        return $this->_routes;
    }

    public function key()
    {
        return key($this->_routes);
    }

    public function valid()
    {
        if ($this->_routes) {
            return true;
        }
        return false;
    }

    public function rewind()
    {
        reset($this->_routes);
    }
}