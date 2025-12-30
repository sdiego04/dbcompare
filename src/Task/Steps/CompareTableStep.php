<?php

namespace DBCompare\Task\Steps;

use DBCompare\Service\CompareTables;
use DBCompare\Service\DataBase\DataBaseHub;
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
        $serviceDataBaseOne = DataBaseHub::create(
            getenv('DB_COMPARE_DB_DRIVER'),
            $this->getFirstDataBaseDsn()
        )->getService();

        $serviceDataBaseTwo = DataBaseHub::create(
            getenv('DB_COMPARE_DB_DRIVER_SECONDARY'),
            $this->getSecondDataBaseDsn()
        )->getService();

        $compareTablesService = new CompareTables(
            $serviceDataBaseOne->getRepository(),
            $serviceDataBaseTwo->getRepository()
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
