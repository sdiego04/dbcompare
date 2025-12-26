<?php

namespace DBCompare\Infrastructure\Driver;

class PostgresqlDriver implements DataBaseDriverInterface
{
    public static function getDriverName(): string
    {
        return EnumDriver::POSTGRESQL->value;
    }

    public function connect(): void
    {
        // Implementation for PostgreSQL connection
    }

    public function setOptions(array $options): void
    {
        // Implement setting options if needed
    }
}