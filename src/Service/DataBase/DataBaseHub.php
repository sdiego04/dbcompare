<?php


namespace DBCompare\Service\DataBase;

use DBCompare\Infrastructure\DataBase\DataBaseDto;
use DBCompare\Service\LoadDriverByName;

class DataBaseHub
{
    public static DataBaseServiceBase $service;
    /**
     * DataBaseHub constructor.
     *
     * @param string $driverName The name of the database driver.
     * @param DataBaseDto $dto The DataBaseDto object containing database connection details.
     * 
     */
    public static function create(string $driverName, DataBaseDto $dto)
    {
        $driver = LoadDriverByName::execute($driverName, $dto);
        switch ($driver->getDriverName()) {
            case 'mysql':
                self::$service = new MySqlService($dto, $driver);
                break;
            default:
                throw new \Exception("Unsupported driver: " . $driverName);
        }

        return new self();
        
    }

    public function getService(): DataBaseServiceBase
    {
        return self::$service;
    }
}