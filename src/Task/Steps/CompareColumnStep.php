<?php

namespace DBCompare\Task\Steps;

use DBCompare\Infrastructure\Repository\MySql\MySqlRepository;
use DBCompare\Service\CompareColumns;
use DBCompare\Service\CompareTables;
use DBCompare\Service\LoadDriverByName;
use DBCompare\Service\OutPutJsonFile;
use DBCompare\Service\StoreJsonFile;

class CompareColumnStep implements StepInterface
{
    use \DBCompare\Helpers\DataBaseHelper;

    /**
     * Returns the name of the step.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Compare Database Columns';
    }

    /**
     * Returns the description of the step.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return 'Compares columns between two database tables and identifies differences.';
    }

    /**
     * Executes the column comparison step.
     *
     * @return void
     * @throws \Exception if an error occurs during execution.
     */
    public function execute(): void
    {

        $driver = LoadDriverByName::execute(getenv('DB_COMPARE_DB_DRIVER'), $this->getFirstDataBaseDsn());
        $driver2 = LoadDriverByName::execute(getenv('DB_COMPARE_DB_DRIVER_SECONDARY'), $this->getSecondDataBaseDsn());
   
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
        $dataJson = OutPutJsonFile::execute();
        $dataJson['columns'] = $response['columns'];
        StoreJsonFile::execute($dataJson);
        echo "Columns successfully compared." . PHP_EOL;
    }
}
