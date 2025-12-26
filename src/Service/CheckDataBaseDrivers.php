<?php

namespace DBCompare\Service;

class CheckDataBaseDrivers
{
    /**
     * @return bool
     */
    public function execute(): bool
    {
        $driverOne = getenv('DB_COMPARE_DB_DRIVER');
        $driverTwo = getenv('DB_COMPARE_DB_DRIVER_SECONDARY');
        $currentDrivers = (new ListDataBaseDrivers())->execute();
        if (!in_array($driverOne, $currentDrivers)) {
            return false;
        }

        if (!in_array($driverTwo, $currentDrivers)) {
            return false;
        }
        return true;
    }
}