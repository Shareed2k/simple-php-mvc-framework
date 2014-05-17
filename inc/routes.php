<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 4/28/14
 * Time: 3:06 PM
 */

$routes['routes'] = array(
    'comment' => array(
        'url' => '/post/addcomment',
        'controller' => 'PostController',
        'action' => 'addComment',
        'methods' => 'POST'
    ),

    'index' => array(
        'url' => '/',
        'controller' => 'someController',
        'action' => 'indexAction',
        'methods' => 'GET'
    ),

    'login' => array(
        'url' => '/login',
        'controller' => 'someController',
        'action' => 'loginAction',
        'methods' => 'GET'
    ),

    'dologin' => array(
    'url' => '/user/login',
    'controller' => 'someController',
    'action' => 'dologinAction',
    'methods' => 'POST'
    ),

    'post' => array(
        'url' => '/post/id/:id',
        'controller' => 'PostController',
        'action' => 'indexAction',
        'methods' => 'GET'
    ),

    'upload' => array(
    'url' => '/upload',
    'controller' => 'PostController',
    'action' => 'uploadAction',
    'methods' => 'POST'
    ),
);