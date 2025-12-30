<?php

namespace DBCompare\Infrastructure\Driver;

use DBCompare\Infrastructure\DataBase\DataBaseDto;
use PDO;

class MysqlDriver extends DriverBase implements DataBaseDriverInterface
{
    /**
     * @MysqlDriver constructor.
     * @param DataBaseDto $dto
     */
    public function __construct(DataBaseDto $dto)
    {
        $this->options =  [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
                PDO::MYSQL_ATTR_SSL_CA => '/Desktop/server.pem',
            ];
        
        parent::__construct($dto);
    }

    /**
     * Establishes a connection to the MySQL database.
     *
     * @throws \Exception if the connection fails.
     */
    public function connect(): void
    {
        $this->connection = new PDO(
            "mysql:host={$this->dto->host};dbname={$this->dto->database};charset=utf8",
            $this->dto->username,
            $this->dto->password,
            $this->options
        );

        if(!$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)) {
            throw new \Exception("Failed to set PDO attributes.");
        }

        if (!$this->connection) {
            throw new \Exception("Failed to connect to the MySQL database.");
        }
    }

    /**
     * Returns the name of the driver.
     *
     * @return string
     */
    public static function getDriverName(): string
    {
        return EnumDriver::MYSQL->value;
    }
}
