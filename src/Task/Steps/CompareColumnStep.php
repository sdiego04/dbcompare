<?php

namespace DBCompare\Task\Steps;

use DBCompare\Infrastructure\DataBase\ConnectDataBase;
use DBCompare\Infrastructure\Driver\EnumDriver;
use DBCompare\Infrastructure\Repository\MySql\MySqlRepository;
use DBCompare\Service\CompareColumns;
use DBCompare\Service\CompareTables;
use DBCompare\Service\CreateJsonFile;
use DBCompare\Service\FindDriverByName;
use DBCompare\Service\GetJsonFile;
use DBCompare\Service\StoreJsonFile;

class CompareColumnStep implements StepInterface
{
    use \DBCompare\Helpers\DataBaseHelper;

    public function getName(): string
    {
        return 'Compare Database Columns';
    }

    public function getDescription(): string
    {
        return 'Compares columns between two database tables and identifies differences.';
    }

    public function execute(): void
    {
        $driver = FindDriverByName::execute(EnumDriver::tryFrom(getenv('DB_COMPARE_DB_DRIVER')), $this->getFirstDataBaseDsn());
        new ConnectDataBase($driver);

        $driver2 = FindDriverByName::execute(EnumDriver::tryFrom(getenv('DB_COMPARE_DB_DRIVER_SECONDARY')), $this->getSecondDataBaseDsn());
        new ConnectDataBase($driver2);

        $compareTablesService = new CompareTables(
            new MySqlRepository($driver),
            new MySqlRepository($driver2)
        );

        $compareTableResponse = $compareTablesService->execute();
        $compareColumnsResponse['only_in_db_one'] = [];
        $compareColumnsResponse['only_in_db_two'] = [];
        foreach ($compareTableResponse['in_both'] as $key => $table) {
            $compareColumnsService = new CompareColumns(
                new MySqlRepository($driver),
                new MySqlRepository($driver2)
            );
            $response = $compareColumnsService->execute($table);
            if (empty($response['only_in_db_one']) && empty($response['only_in_db_two'])) {
                continue;
            }

            if (!empty($response['only_in_db_one'])) {
                $compareColumnsResponse['only_in_db_one'][$table] = $response['only_in_db_one'];
            }
            if (!empty($response['only_in_db_two'])) {
                $compareColumnsResponse['only_in_db_two'][$table] = $response['only_in_db_two'];
            }
        }

        $response['columns'] = $compareColumnsResponse ?? [];
        $dataJson = GetJsonFile::execute();
        $dataJson['columns'] = $response['columns'];
        StoreJsonFile::execute($dataJson);
        echo "Columns successfully compared." . PHP_EOL;
    }
}
