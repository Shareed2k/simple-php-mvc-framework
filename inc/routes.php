<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 4/28/14
 * Time: 3:06 PM
 */

$routes['routes'] = array(
    'contact' => array(
        'url' => '/contact',
        'controller' => 'someController',
        'action' => 'contactAction',
        'methods' => 'GET'
    ),

    'index' => array(
        'url' => '/',
        'controller' => 'someController',
        'action' => 'indexAction',
        'methods' => 'GET'
    ),

    '404' => array(
        'url' => '/error/:id/:ds',
        'controller' => 'someController',
        'action' => 'errorAction',
        'methods' => 'GET'
    )
);