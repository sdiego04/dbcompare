<?php

namespace DBCompare\Service\DataBase;

abstract class DataBaseServiceBase
{

    protected \DBCompare\Infrastructure\DataBase\DataBaseDto $dto;
    protected \DBCompare\Infrastructure\Driver\DriverBase $driver;

    /**
     * DataBaseServiceBase constructor.
     *
     * @param \DBCompare\Infrastructure\DataBase\DataBaseDto $dto The DataBaseDto object containing database connection details.
     * @param \DBCompare\Infrastructure\Driver\DriverBase $driver The database driver.
     */
    public function __construct(
        \DBCompare\Infrastructure\DataBase\DataBaseDto $dto,
        \DBCompare\Infrastructure\Driver\DriverBase $driver)
    {
       $this->dto = $dto;
       $this->driver = $driver;
    }
    
    /**
     * Gets the repository for the database service.
     *
     * @return \DBCompare\Infrastructure\Repository\RepositoryInterface The repository instance.
     */
    abstract public function getRepository(): \DBCompare\Infrastructure\Repository\RepositoryInterface;
}