<?php

class EnumDriverTest extends \PHPUnit\Framework\TestCase
{
    public function testEnumDriverExists(): void
    {
        $this->assertTrue(enum_exists(\DBCompare\Infrastructure\Driver\EnumDriver::class));
    }

    public function testEnumDriverCases(): void
    {
        $cases = \DBCompare\Infrastructure\Driver\EnumDriver::cases();
        $this->assertCount(3, $cases);

        $this->assertEquals('mysql', \DBCompare\Infrastructure\Driver\EnumDriver::MYSQL->value);
        $this->assertEquals('pgsql', \DBCompare\Infrastructure\Driver\EnumDriver::POSTGRESQL->value);
        $this->assertEquals('sqlite', \DBCompare\Infrastructure\Driver\EnumDriver::SQLITE->value);
    }
}