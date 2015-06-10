<?php

namespace ExtDirect\Cache;

use ExtDirect\Annotations\Collections\DirectCollection;
use ExtDirect\Utils\Keys;

class ExtCacheTest extends \PHPUnit_Framework_TestCase
{
    protected $cacheKey = "unittests";

    protected $exampleApi = array(
        "url" => "extDirect.php",
        "type" => "remoting",
        "actions" => Array(
            "DemoApp" => Array(
                Array(
                    "name" => "getTree",
                    "len" => 0
                ),
                Array(
                    "name" => "getList",
                    "len" => 0
                )
            )
        )
    );

    protected static function getMethod($name) {
        $class = new \ReflectionClass('ExtDirect\Cache\ExtCache');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    public function testIsApiCached()
    {
        apc_clear_cache();

        $cache = new ExtCache($this->cacheKey);
        $this->assertFalse($cache->isApiCached());
    }

    public function testGetApi()
    {
        apc_clear_cache();

        $cache = new ExtCache($this->cacheKey);
        $this->assertFalse($cache->getApi());
    }

    public function testGetNonExistentKey()
    {
        apc_clear_cache();

        $get = self::getMethod('get');
        $set = self::getMethod('set');
        $cache = new ExtCache($this->cacheKey);
        $set->invokeArgs($cache, array("key", "value"));
        $this->assertFalse($get->invokeArgs($cache, array("nonExisting")));
    }


    public function testSetAndGet()
    {
        apc_clear_cache();

        $set = self::getMethod('set');

        $get = self::getMethod('get');

        $cache = new ExtCache($this->cacheKey);
        $set->invokeArgs($cache, array("key", "value"));
        $this->assertEquals("value", $get->invokeArgs($cache, array("key")));

    }

    public function testSetAndGetApiKey()
    {
        apc_clear_cache();

        $set = self::getMethod('set');

        $get = self::getMethod('get');

        $cache = new ExtCache($this->cacheKey);
        $set->invokeArgs($cache, array(Keys::EXT_API, array("dummy")));
        $this->assertEquals(array("dummy"), $get->invokeArgs($cache, array(Keys::EXT_API)));
    }

    public function testCacheApi()
    {
        apc_clear_cache();

        $cache = new ExtCache($this->cacheKey);
        $cache->cacheApi($this->exampleApi);

        $this->assertTrue($cache->isApiCached());
        $this->assertEquals($this->exampleApi, $cache->getApi());
    }

    public function testCacheActions()
    {
        apc_clear_cache();

        $directCollection = new DirectCollection();

        $cache = new ExtCache($this->cacheKey);
        $cache->cacheActions($directCollection);

        $this->assertTrue($cache->isCached());

        $this->assertEquals($directCollection, $cache->getActions());
    }

    public function testGetActionsNotSet()
    {
        apc_clear_cache();

        $cache = new ExtCache($this->cacheKey);

        $this->assertFalse($cache->isCached());

        $this->assertEmpty($cache->getActions());
    }
}