<?php

namespace DBCompare\Task\Steps;

use DBCompare\Infrastructure\Repository\MySql\MySqlRepository;
use DBCompare\Service\CompareTables;
use DBCompare\Service\LoadDriverByName;
use DBCompare\Service\StoreJsonFile;

class CompareTableStep implements StepInterface
{
    use \DBCompare\Helpers\DataBaseHelper;

    /**
     *  
     * @return string
     * 
     */
    public function getName(): string
    {
        return 'Compare Database Tables';
    }

    /**
     *  
     * @return string
     * 
     */
    public function getDescription(): string
    {
        return 'Compares tables between two databases and identifies differences.';
    }

    /**
     * Executes the table comparison between two databases.
     *
     * @return void
     */
    public function execute(): void
    {
        $driver = LoadDriverByName::execute(
            getenv('DB_COMPARE_DB_DRIVER'), $this->getFirstDataBaseDsn());
        $driver2 = LoadDriverByName::execute(
            getenv('DB_COMPARE_DB_DRIVER_SECONDARY'), $this->getSecondDataBaseDsn());

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
