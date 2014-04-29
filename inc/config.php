<?php
/**
 * Created by PhpStorm.
 * User: Shareed2k
 * Date: 4/27/14
 * Time: 7:19 PM
 */

date_default_timezone_get('Asia/Jerusalem');

if(!isset($_SESSION)){session_start();}

defined("DS") || define("DS", DIRECTORY_SEPARATOR);

defined("ROOT_PATH") || define("ROOT_PATH", realpath(dirname(__FILE__) . DS . ".." . DS));

defined("CLASSES_PATH") || define("CLASSES_PATH", ROOT_PATH . DS . 'classes');

defined("TEMPLATE") || define("TEMPLATE", ROOT_PATH . DS . 'template');

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(ROOT_PATH),
    realpath(CLASSES_PATH),
    get_include_path()
)));


/**
 * database
 */
defined("DB_HOST") || define("DB_HOST", "localhost");
defined("DB_NAME") || define("DB_NAME", "test_mvc");
defined("DB_PASS") || define("DB_PASS", "root");
defined("DB_USER") || define("DB_USER", "root");