<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Use Composer autoloader:
$loader = require_once "../vendor/autoload.php";

// Mapping for app classes:
$loader->addPsr4('App\\', '../app');

// Init and run the application:
$app = new \Mindk\Framework\App( require "../config/config.php" );
$app->run();

