<?php

namespace DBCompare\Service;

use DBCompare\Infrastructure\DataBase\DataBaseDto;
use DBCompare\Infrastructure\Driver\DataBaseDriverInterface;
use DBCompare\Infrastructure\Driver\EnumDriver;

class FindDriverByName
{
    public static function execute(EnumDriver $name, DataBaseDto $dto): DataBaseDriverInterface
    {
        return match ($name) {
            EnumDriver::MYSQL => new \DBCompare\Infrastructure\Driver\MysqlDriver($dto),
            //EnumDriver::POSTGRESQL => new \DBCompare\Infrastructure\Driver\PostgreSqlDriver(),
            default => throw new \Exception("Driver not found: " . $name->value),
        };
    }
}