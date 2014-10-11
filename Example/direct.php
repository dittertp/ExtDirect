<?php

require ("../vendor/autoload.php");

use ExtDirect\ExtDirect;

$request = array();
$request['type'] = "rpc";
$request['tid'] = 1;
$request['action'] = "DemoApp";
$request['method'] = "getTree";
$request['data'] = array("demoKey"=>"demoValue");

$direct = new ExtDirect();
$direct->setApplicationPath("ExtDirectDemoApp");
$direct->call("init", array("initparameter"));
$direct->setParamMethod("setParams");

$direct->processRequest($request);

$result = $direct->getResponse()->asArray();

// error_log(var_export($result, true));

print_r($result);
