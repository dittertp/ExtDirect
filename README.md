

### ExtApi Beispiel:

``` php
require ("../vendor/autoload.php");

use ExtDirect\ExtDirect;

$request = array();
$request['type'] = "rpc";
$request['tid'] = 1;
$request['action'] = "DemoApp";
$request['method'] = "DemoAction";
$request['data'] = array("asd"=>"gfs");

$direct = new ExtDirect();

$api = $direct->getApi();
$api->setUrl("extDirect.php");
$api->setApplicationPath("Application");

$jsonApi = $api->getApi();
```

### ExtDirect Batched Request Beispiel:

``` php
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

$result = $direct->getResponse()->asArray();
```

### ExtDirect Batched Request Beispiel:

``` php
<?php

require ("../vendor/autoload.php");

use ExtDirect\ExtDirect;


$request1 = array();
$request1['type'] = "rpc";
$request1['tid'] = 1;
$request1['action'] = "DemoApp";
$request1['method'] = "getTree";
$request1['data'] = array("asd"=>"gfs");

$request2 = array();
$request2['type'] = "rpc";
$request2['tid'] = 2;
$request2['action'] = "DemoApp";
$request2['method'] = "getTree4";
$request2['data'] = array("asd"=>"gfs");

$request = array($request1, $request2);


$direct = new ExtDirect();
$direct->setApplicationPath("Application");
$direct->call("init", array("initparameter"));
$direct->setParamMethod("setParams");

$direct->processRequest($request);

$result = $direct->getResponse()->asArray();
```