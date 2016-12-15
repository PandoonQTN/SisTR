<?php

define('SISTR', '');
define('APPLICATION_PATH', __DIR__ . "\application");
define('APPLICATION_NAMESPACE', "Sistr");
define('ROOT_PATH', __DIR__);
require_once './framework/f3il.php';
$app = \F3il\Application::getInstance(APPLICATION_PATH . "\\configuration.ini");
$app->setDefaultControllerName("index");
$app->setAuthenticationDelegate("UtilisateursModel");
$app->run();



