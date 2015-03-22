<?php

require ("../vendor/autoload.php");

use ExtDirect\ExtDirect;

$direct = new ExtDirect();
$direct->setApplicationNameSpace("ExtDirectDemoApp");
$direct->setApplicationPath("ExtDirectDemoApp");

$api = $direct->getApi();
$api->setUrl("extDirect.php");
$api->setNameSpace("Ext.app");

$jsonApi = $api->getApi();

echo $jsonApi;
