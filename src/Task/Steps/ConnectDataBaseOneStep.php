<?php

namespace DBCompare\Task\Steps;

use DBCompare\Infrastructure\Driver\EnumDriver;
use DBCompare\Service\FindDriverByName;

class ConnectDataBaseOneStep implements StepInterface
{
    use \DBCompare\Helpers\DataBaseHelper;

    public function getName(): string
    {
        return 'Connect to Database One';
    }

    public function getDescription(): string
    {
        return 'Establishes a connection to the first database using provided credentials.';
    }

    public function execute(): void
    {
        $driver = FindDriverByName::execute(EnumDriver::tryFrom(getenv('DB_COMPARE_DB_DRIVER')), $this->getFirstDataBaseDsn());
        new \DBCompare\Infrastructure\DataBase\ConnectDataBase($driver);
        echo "Connected to Database One: " . $this->getFirstDataBaseDsn()->database . PHP_EOL;
    }
}
