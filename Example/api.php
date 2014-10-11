<?php

require ("../vendor/autoload.php");

use ExtDirect\ExtDirect;

$direct = new ExtDirect();

$api = $direct->getApi();
$api->setUrl("extDirect.php");
$api->setApplicationPath("ExtDirectDemoApp");

$jsonApi = $api->getApi();

// error_log(var_export($jsonApi, true));

print_r($jsonApi);
