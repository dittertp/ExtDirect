[![Build Status](https://travis-ci.org/dittertp/ExtDirect.svg?branch=master)](https://travis-ci.org/dittertp/ExtDirect)
 [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dittertp/ExtDirect/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dittertp/ExtDirect/?branch=master)

### ExtApi example:

``` php
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
```

### ExtDirect request example:

``` php
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
$direct->setApplicationNameSpace("ExtDirectDemoApp");
$direct->setApplicationPath("ExtDirectDemoApp");

$direct->call("init", array("initparameter"));
$direct->setParamMethod("setParams");

$direct->processRequest($request);

$result = $direct->getResponse()->asArray();

print_r($result);
```

### ExtDirect batched request example:

``` php
<?php

require ("../vendor/autoload.php");

use ExtDirect\ExtDirect;


$request1 = array();
$request1['type'] = "rpc";
$request1['tid'] = 1;
$request1['action'] = "DemoApp";
$request1['method'] = "getTree";
$request1['data'] = array("demoKey"=>"demoValue");

$request2 = array();
$request2['type'] = "rpc";
$request2['tid'] = 2;
$request2['action'] = "DemoApp";
$request2['method'] = "getList";
$request2['data'] = array("demoKey"=>"demoValue");

$request = array($request1, $request2);


$direct = new ExtDirect();
$direct->setApplicationNameSpace("ExtDirectDemoApp");
$direct->setApplicationPath("ExtDirectDemoApp");

$direct->call("init", array("initparameter"));
$direct->setParamMethod("setParams");

$direct->processRequest($request);

$result = $direct->getResponse()->asArray();

print_r($result);
```


### example using annotations

``` php
/**
 * @Direct(name="DemoApp")
 */
class DemoAppController
{
    /**
     * @Remotable(name = "getTree")
     */
    public function TreeAction()
    {
        return array("success"=>true);
    }

    /**
     * @Remotable(name = "getList")
     */
    public function ListAction()
    {
        return array("success"=>true);
    }
```

### example "application"

add example demo to autoloader configuration in composer.json

``` js
    "autoload": {
        "psr-0": {
            "ExtDirect": "src/",
            "ExtDirectDemoApp": "Example/"
        }
    }
```

and execute ``composer update``. Now your are able to run the scripts inside the ``Example`` folder

``` bash
cd Example

php api.php
php direct.php
php batchedDirect.php

```





