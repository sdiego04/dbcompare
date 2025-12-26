<?php

namespace DBCompare\Service;

use DBCompare\Infrastructure\Repository\RepositoryInterface;

class CompareColumns
{
    private RepositoryInterface $repositoryOne;
    private RepositoryInterface $repositoryTwo;

    public function __construct(
        RepositoryInterface $repositoryOne,
        RepositoryInterface $repositoryTwo
    )
    {
        $this->repositoryOne = $repositoryOne;
        $this->repositoryTwo = $repositoryTwo;
    }

    public function execute(string $tableName): array
    {
        $columnsOne = $this->repositoryOne->getTableColumns($tableName);
        $columnsTwo = $this->repositoryTwo->getTableColumns($tableName);
        $columnsOneNames = array_map(fn($col) => $col['COLUMN_NAME'], $columnsOne);
        $columnsTwoNames = array_map(fn($col) => $col['COLUMN_NAME'], $columnsTwo);
        return [
           // 'in_both' => array_values(array_intersect($columnsOneNames, $columnsTwoNames)),
            'only_in_db_one' => array_values(array_diff($columnsOneNames, $columnsTwoNames)),
            'only_in_db_two' =>  array_values(array_diff($columnsTwoNames, $columnsOneNames)),
        ];
    }
}