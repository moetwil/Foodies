<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

error_reporting(E_ALL);
ini_set("display_errors", 1);

// trim the url
$uri = trim($_SERVER['REQUEST_URI'], '/');

// require the router and create a new instance
require __DIR__ . '/../patternrouter.php';
$router = new PatternRouter();

// pass the uri to the router
$router->route($uri);