<?php

class EnumDataBaseTest extends \PHPUnit\Framework\TestCase
{
    public static function setUpBeforeClass(): void
    {
        echo "Setting up test EnumDataBaseTest" . PHP_EOL;
        parent::setUpBeforeClass();
    }

    public function testEnumCases(): void
    {
        $expectedCases = [
            'DB_COMPARE_DB_NAME',
            'DB_COMPARE_DB_NAME_SECONDARY',
            'DB_COMPARE_DB_DRIVER',
            'DB_COMPARE_DB_DRIVER_SECONDARY',
            'DB_COMPARE_DB_HOST',
            'DB_COMPARE_DB_HOST_SECONDARY',
            'DB_COMPARE_DB_PORT',
            'DB_COMPARE_DB_PORT_SECONDARY',
            'DB_COMPARE_DB_USER',
            'DB_COMPARE_DB_USER_SECONDARY',
            'DB_COMPARE_DB_PASSWORD',
            'DB_COMPARE_DB_PASSWORD_SECONDARY',
            'DB_COMPARE_DB_SSL_CERT',
            'DB_COMPARE_DB_SSL_CERT_SECONDARY',
        ];

        $enumCases = \DBCompare\Infrastructure\DataBase\EnumDataBase::cases();
        $this->assertCount(count($expectedCases), $enumCases);

        foreach ($enumCases as $index => $case) {
            $this->assertEquals($expectedCases[$index], $case->name);
        }
    }
}
