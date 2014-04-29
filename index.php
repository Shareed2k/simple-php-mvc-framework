<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 4/27/14
 * Time: 4:54 PM
 */

require_once __DIR__ . '/inc/autoload.php';
require_once __DIR__ . '/inc/config.php';
require_once __DIR__ . '/inc/routes.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespace('Shareed2k', __DIR__.DS.'classes');
$loader->registerNamespace('Controllers', __DIR__.DS.'controller');
$loader->registerNamespace('View', __DIR__.DS.'view');
$loader->registerNamespace('Model', __DIR__.DS.'model');
$loader->register();

$router = \Shareed2k\Router::parseRouteArray($routes);

$router->setBasePath(DS.'mvc_cms');

\Shareed2k\Core::run($router);