<?php

namespace DBCompare\Infrastructure\Repository;

interface RepositoryInterface
{
    public function getAllTables(): array;
    public function getTableColumns(string $tableName): array;
}