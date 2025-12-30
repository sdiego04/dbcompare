<?php

namespace DBCompare\Infrastructure\Repository;

interface RepositoryInterface
{
    /**
     * @return array
     */
    public function getAllTables(): array;

    /**
     * @param string $tableName
     * @return array
     */
    public function getTableColumns(string $tableName): array;
}