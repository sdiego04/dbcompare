<?php

namespace DBCompare\Task\Steps;

use DBCompare\Infrastructure\DataBase\ConnectDataBase;
use DBCompare\Infrastructure\Driver\EnumDriver;
use DBCompare\Infrastructure\Repository\MySql\MySqlRepository;
use DBCompare\Service\CompareTables;
use DBCompare\Service\CreateJsonFile;
use DBCompare\Service\FindDriverByName;
use DBCompare\Service\StoreJsonFile;

class CompareTableStep implements StepInterface
{
    use \DBCompare\Helpers\DataBaseHelper;

    public function getName(): string
    {
        return 'Compare Database Tables';
    }

    public function getDescription(): string
    {
        return 'Compares tables between two databases and identifies differences.';
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

        $response = [];
        $response['databases'] = [
            'database_one' => $this->getFirstDataBaseDsn()->database,
            'database_two' => $this->getSecondDataBaseDsn()->database,
        ];

        $response['tables'] = $compareTablesService->execute();
        StoreJsonFile::execute($response);

        echo "Tables successfully compared." . PHP_EOL;
    }
}
