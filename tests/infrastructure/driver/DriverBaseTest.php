<?php

use DBCompare\Infrastructure\DataBase\DataBaseDto;

class DriverBaseTest extends \PHPUnit\Framework\TestCase
{
    public static function setUpBeforeClass(): void
    {
        echo "Setting up test DriverBaseTest" . PHP_EOL;
        parent::setUpBeforeClass();
    }

    public function testAbstractClassExists(): void
    {
        $this->assertTrue(class_exists(\DBCompare\Infrastructure\Driver\DriverBase::class));
        $this->assertTrue((new \ReflectionClass(\DBCompare\Infrastructure\Driver\DriverBase::class))->isAbstract());
    }

    public function testGetConnectionMethodExists(): void
    {
        $reflection = new \ReflectionClass(\DBCompare\Infrastructure\Driver\DriverBase::class);
        $this->assertTrue($reflection->hasMethod('getConnection'));

        $method = $reflection->getMethod('getConnection');
        $this->assertTrue($method->isPublic());
        $this->assertFalse($method->isAbstract());
    }

    public function testGetDriverNameMethodExists(): void
    {
        $reflection = new \ReflectionClass(\DBCompare\Infrastructure\Driver\DriverBase::class);
        $this->assertTrue($reflection->hasMethod('getDriverName'));

        $method = $reflection->getMethod('getDriverName');
        $this->assertTrue($method->isPublic());
        $this->assertTrue($method->isAbstract());
        $this->assertTrue($method->isStatic());
    }

    public function testSetOptionsMethodExists(): void
    {
        $reflection = new \ReflectionClass(\DBCompare\Infrastructure\Driver\DriverBase::class);
        $this->assertTrue($reflection->hasMethod('setOptions'));

        $method = $reflection->getMethod('setOptions');
        $this->assertTrue($method->isPublic());
        $this->assertFalse($method->isAbstract());
    }

    public function testDisconnectMethodExists(): void
    {
        $reflection = new \ReflectionClass(\DBCompare\Infrastructure\Driver\DriverBase::class);
        $this->assertTrue($reflection->hasMethod('disconnect'));

        $method = $reflection->getMethod('disconnect');
        $this->assertTrue($method->isPublic());
        $this->assertFalse($method->isAbstract());
    }

    public function testConnectMethodExists(): void
    {
        $reflection = new \ReflectionClass(\DBCompare\Infrastructure\Driver\DriverBase::class);
        $this->assertTrue($reflection->hasMethod('connect'));

        $method = $reflection->getMethod('connect');
        $this->assertTrue($method->isPublic());
        $this->assertTrue($method->isAbstract());
    }

    public function testConstructorExists(): void
    {
        $reflection = new \ReflectionClass(\DBCompare\Infrastructure\Driver\DriverBase::class);
        $this->assertTrue($reflection->hasMethod('__construct'));

        $method = $reflection->getMethod('__construct');
        $this->assertTrue($method->isPublic());
        $this->assertFalse($method->isAbstract());
    }

    public function testPropertiesExist(): void
    {
        $reflection = new \ReflectionClass(\DBCompare\Infrastructure\Driver\DriverBase::class);

        $this->assertTrue($reflection->hasProperty('connection'));
        $connectionProp = $reflection->getProperty('connection');
        $this->assertTrue($connectionProp->isProtected());
        $this->assertEquals('?PDO', (string)$connectionProp->getType());

        $this->assertTrue($reflection->hasProperty('dto'));
        $dtoProp = $reflection->getProperty('dto');
        $this->assertTrue($dtoProp->isProtected());
        $this->assertEquals(DataBaseDto::class, (string)$dtoProp->getType());

        $this->assertTrue($reflection->hasProperty('options'));
        $optionsProp = $reflection->getProperty('options');
        $this->assertTrue($optionsProp->isProtected());
        $this->assertEquals('?array', (string)$optionsProp->getType());
    }
}