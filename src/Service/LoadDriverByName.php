<?php

namespace DBCompare\Service;

use DBCompare\Infrastructure\DataBase\DataBaseDto;
use DBCompare\Infrastructure\Driver\DriverBase;
use DBCompare\Infrastructure\Driver\EnumDriver;

class LoadDriverByName
{
    /**
     * Loads a database driver by its name.
     * @param string $name The name of the driver.
     * @param DataBaseDto $dto The DataBaseDto object containing database connection details.
     * @return DriverBase The loaded database driver.
     * @throws \Exception if the driver is not found.
     */
    public static function execute(string $name, DataBaseDto $dto): DriverBase
    {
        $name = strtolower($name);
        return match ($name) {
            EnumDriver::MYSQL->value => new \DBCompare\Infrastructure\Driver\MysqlDriver($dto),
            //EnumDriver::POSTGRESQL => new \DBCompare\Infrastructure\Driver\PostgreSqlDriver(),
            default => throw new \Exception("Driver not found: " . $name),
        };
    }
}