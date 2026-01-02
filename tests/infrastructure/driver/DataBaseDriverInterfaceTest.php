<?php

class DataBaseDriverInterfaceTest extends \PHPUnit\Framework\TestCase
{
    public static function setUpBeforeClass(): void
    {
        echo "Setting up test DataBaseDriverInterfaceTest" . PHP_EOL;
        parent::setUpBeforeClass();
    }

    public function testInterfaceExists(): void
    {
        $this->assertTrue(interface_exists(\DBCompare\Infrastructure\Driver\DataBaseDriverInterface::class));
    }
}