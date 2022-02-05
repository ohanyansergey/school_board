<?php

// Require Autoload
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Autoload.php');

// Call Router
$router = new Router();
$router->run();


