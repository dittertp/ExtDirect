

### ExtApi Beispiel:

``` php
<?php

require ("../vendor/autoload.php");

use ExtDirect\ExtDirect;

$direct = new ExtDirect();

$api = $direct->getApi();
$api->setUrl("extDirect.php");
$api->setApplicationPath("ExtDirectDemoApp");

$jsonApi = $api->getApi();

print_r($jsonApi);
```

### ExtDirect Request Beispiel:

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
$direct->setApplicationPath("ExtDirectDemoApp");
$direct->call("init", array("initparameter"));
$direct->setParamMethod("setParams");

$direct->processRequest($request);

$result = $direct->getResponse()->asArray();

print_r($result);
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
$request1['data'] = array("demoKey"=>"demoValue");

$request2 = array();
$request2['type'] = "rpc";
$request2['tid'] = 2;
$request2['action'] = "DemoApp";
$request2['method'] = "getList";
$request2['data'] = array("demoKey"=>"demoValue");

$request = array($request1, $request2);


$direct = new ExtDirect();
$direct->setApplicationPath("ExtDirectDemoApp");
$direct->call("init", array("initparameter"));
$direct->setParamMethod("setParams");

$direct->processRequest($request);

$result = $direct->getResponse()->asArray();

print_r($result);
```


### Beispiel für Annotations

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

### Beispiel "Anwendung"

DemoApp im autoloader registrieren

``` js
    "autoload": {
        "psr-0": {
            "ExtDirect": "src/",
            "ExtDirectDemoApp": "Example/"
        }
    }
```

Danach ``composer update`` ausführen. Die Beispiel-Scripte können über folgende Befehle ausgeführt werden:

``` bash
cd Example

php api.php
php direct.php
php batchedDirect.php

```





