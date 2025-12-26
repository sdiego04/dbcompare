<?php

namespace DBCompare\Service;

use DBCompare\Infrastructure\DataBase\ConnectDataBase;
use DBCompare\Infrastructure\Driver\EnumDriver;
use DBCompare\Infrastructure\Repository\MySql\MySqlRepository;

class InitProcessCompare
{
    use \DBCompare\Helpers\DataBaseHelper;

    public function run():array
    {
        try {
            $driver = FindDriverByName::execute(EnumDriver::tryFrom(getenv('DB_COMPARE_DB_DRIVER')), $this->getFirstDataBaseDsn());
            $dataBaseOne = new ConnectDataBase($driver);
            
            $driver2 = FindDriverByName::execute(EnumDriver::tryFrom(getenv('DB_COMPARE_DB_DRIVER_SECONDARY')), $this->getSecondDataBaseDsn());
            $dataBaseTwo = new ConnectDataBase($driver2);

            $compareTablesService = new CompareTables(
                new MySqlRepository($driver),
                new MySqlRepository($driver2)
            );
            $response = [];
            $response['databases'] = [
                'database_one' => $this->getFirstDataBaseDsn()->database,
                'database_two' => $this->getSecondDataBaseDsn()->database,
            ];
            $compareTableResponse = $compareTablesService->execute();
            
            $compareColumnsResponse['only_in_db_one'] = [];
            $compareColumnsResponse['only_in_db_two'] = [];
            foreach ($compareTableResponse['in_both'] as $key => $table) {
                $compareColumnsService = new CompareColumns(
                    new MySqlRepository($driver),
                    new MySqlRepository($driver2)
                );
                $response = $compareColumnsService->execute($table);
                if(empty($response['only_in_db_one']) && empty($response['only_in_db_two'])){
                   continue;
                } 

                if(!empty($response['only_in_db_one'])){
                    $compareColumnsResponse['only_in_db_one'][$table] = $response['only_in_db_one'];
                }
                if(!empty($response['only_in_db_two'])){
                    $compareColumnsResponse['only_in_db_two'][$table] = $response['only_in_db_two'];
                }
            }
            $response['tables'] = $compareTableResponse;
            $response['columns'] = $compareColumnsResponse ?? [];
            return $response;
        } catch (\Exception $e) {
            throw new \Exception("Failed to initialize databases: " . $e->getMessage());
        }
    }
}