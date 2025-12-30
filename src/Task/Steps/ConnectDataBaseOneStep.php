<?php

namespace DBCompare\Task\Steps;

use DBCompare\Infrastructure\Driver\EnumDriver;
use DBCompare\Service\FindDriverByName;
use DBCompare\Service\LoadDriverByName;
use LogicException;

class ConnectDataBaseOneStep implements StepInterface
{
    use \DBCompare\Helpers\DataBaseHelper;

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Connect to Database One';
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Establishes a connection to the first database using provided credentials.';
    }

    /**
     * Executes the step to connect to the first database.
     *
     * @throws \Exception if the connection fails.
     */
    public function execute(): void
    {
        $driver = LoadDriverByName::execute(getenv('DB_COMPARE_DB_DRIVER'), $this->getFirstDataBaseDsn());
        $driver->connect();
        echo "Connected to Database One: " . $this->getFirstDataBaseDsn()->database . PHP_EOL;
    }
}
