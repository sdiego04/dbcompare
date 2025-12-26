<?php

namespace DBCompare\Infrastructure\Driver;

interface DataBaseDriverInterface
{
    /**
     * Get the name of the driver
     * @return string
     */
    public static function getDriverName(): string;

    public function connect(): void;

    //  public function disconnect(): void;

    public function setOptions(array $options): void;
}
