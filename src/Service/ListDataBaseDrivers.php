<?php

namespace DBCompare\Service;


/**
 * Class to list available database drivers
 * @package DBCompare\Service
 * 
 */
class ListDataBaseDrivers
{

    /**
     * Execute the service to list available database drivers
     * @return array List of available database drivers
     */
    public function execute(): array
    {
        $interface = \DBCompare\Infrastructure\Driver\DataBaseDriverInterface::class;
        $drivers = [];
        $dir = __DIR__ . '/../Infrastructure/Driver';
        foreach (glob($dir . '/*.php') as $file) {
            require_once $file;
        }
         
        foreach (get_declared_classes() as $class) {
            if (in_array($interface, class_implements($class))) {
                $drivers[] = $class::getDriverName();
            }
        }
        return $drivers;
    }
}
