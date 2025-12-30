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
    public function connect(): void
    {
        throw new \Exception('Not implemented');
    }

    /**
     * Returns the PDO connection.
     *
     * @return \PDO|null
     */
    public function getConnection(): ?\PDO
    {
        return $this->connection;
    }

    /**
     * Returns the name of the driver.
     *
     * @return string
     */    
    public static function getDriverName(): string
    {
        throw new \Exception('Not implemented');
    }

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