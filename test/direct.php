<?php

require ("../vendor/autoload.php");

use ExtDirect\ExtDirect;

$request = array();
$request['type'] = "rpc";
$request['tid'] = 1;
$request['action'] = "DemoApp";
$request['method'] = "getTree";
$request['data'] = array("asd"=>"gfs");

$direct = new ExtDirect();
$direct->setApplicationPath("Application");
$direct->call("init", array("initparameter"));
$direct->setParamMethod("setParams");

$direct->processRequest($request);

//$result = $direct->getResponse()->getResultAsArray();
$result = $direct->getResponse()->asArray();

error_log(var_export($result, true));
