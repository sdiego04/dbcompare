<?php


namespace DBCompare\Infrastructure\Repository\MySql;

use DBCompare\Infrastructure\Driver\DriverBase;

class MySqlRepository implements \DBCompare\Infrastructure\Repository\RepositoryInterface
{
    private DriverBase $mysqlDriver;

    /**
     * @param DriverBase $mysqlDriver
     */
    public function __construct(DriverBase $mysqlDriver)
    {
        $this->mysqlDriver = $mysqlDriver;
    }

    /**
     * Retrieves all table names from the MySQL database.
     *
     * @return array
     */
    public function getAllTables(): array
    {
       $stmt = $this->mysqlDriver->getConnection()->query("SHOW TABLES");
       return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    /**
     * Retrieves column information for a specific table.
     *
     * @param string $tableName
     * @return array
     */
    public function getTableColumns(string $tableName): array
    {
        $stmt = $this->mysqlDriver->getConnection()->prepare("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME  = '$tableName'");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}