<?php

require ("../vendor/autoload.php");

use ExtDirect\ExtDirect;

$request = array();
$request['type'] = "rpc";
$request['tid'] = 1;
$request['action'] = "DemoApp";
$request['method'] = "DemoAction";
$request['data'] = array("asd"=>"gfs");

$direct = new ExtDirect();
#$direct->setApplicationPath("Application");
#$direct->processRequest($request);

$api = $direct->getApi();

$api->setNamespace("Application");
$api->setApplicationPath("Application");
$api->setAppNamespace("Application");
$api->getActions();

error_log(var_export($direct->getResponse(),true));

