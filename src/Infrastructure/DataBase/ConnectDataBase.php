<?php

namespace DBCompare\Infrastructure\DataBase;

use DBCompare\Infrastructure\Driver\DataBaseDriverInterface;
use PDO;
use PDOException;

class ConnectDataBase
{
    private PDO $connection;

    /**
     * @ConnectDataBase constructor.
     * @param DataBaseDto $dto
     * @throws PDOException
     */
    public function __construct(DataBaseDriverInterface $driver)
    {
        try {
            $driver->connect();
        } catch (PDOException $e) {
            throw new PDOException("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}