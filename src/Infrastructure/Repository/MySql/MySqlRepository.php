<?php


namespace DBCompare\Infrastructure\Repository\MySql;

use DBCompare\Infrastructure\Driver\MysqlDriver;

class MySqlRepository implements \DBCompare\Infrastructure\Repository\RepositoryInterface
{
    private MysqlDriver $mysqlDriver;

    public function __construct(MysqlDriver $mysqlDriver)
    {
        $this->mysqlDriver = $mysqlDriver;
    }

    public function getAllTables(): array
    {
       $stmt = $this->mysqlDriver->getConnection()->query("SHOW TABLES");
       return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function getTableColumns(string $tableName): array
    {
        $stmt = $this->mysqlDriver->getConnection()->prepare("SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME  = '$tableName'");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}