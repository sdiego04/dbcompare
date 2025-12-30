<?php


namespace DBCompare\Infrastructure\Driver;

use DBCompare\Infrastructure\DataBase\DataBaseDto;

abstract class DriverBase
{
    protected ?\PDO $connection = null;
    protected DataBaseDto $dto;
    protected ?array $options = null;

    public function __construct(DataBaseDto $dto)
    {
        $this->dto = $dto;
        $this->connect();
    }

    /**
     * Establishes a connection to the database.
     *
     * @throws \Exception if the connection fails.
     */
    public abstract function connect(): void;

    /**
     * Returns the PDO connection.
     *
     * @return \PDO|null
     */
    public abstract function getConnection(): ?\PDO;

    /**
     * Returns the name of the driver.
     *
     * @return string
     */    
    public abstract static function getDriverName(): string;

    /**
     * Sets additional options for the database connection.
     *
     * @param array $options
     */
    public function setOptions(array $options): void
    {
        $this->options = array_merge($this->options, $options);
    }

    /**
     * Disconnects from the database.
     */
    public function disconnect(): void
    {
       $this->connection = null;
    }
}