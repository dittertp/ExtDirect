

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