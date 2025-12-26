<?php

namespace DBCompare\Task\Steps;

class ConnectDataBaseTwoStep implements StepInterface
{
    use \DBCompare\Helpers\DataBaseHelper;

    public function getName(): string
    {
        return 'Connect to Database Two';
    }

    public function getDescription(): string
    {
        return 'Establishes a connection to the second database using provided credentials.';
    }

    public function execute(): void
    {
        $driver = \DBCompare\Service\FindDriverByName::execute(
            \DBCompare\Infrastructure\Driver\EnumDriver::tryFrom(getenv('DB_COMPARE_DB_DRIVER_SECONDARY')),
            $this->getSecondDataBaseDsn()
        );
        new \DBCompare\Infrastructure\DataBase\ConnectDataBase($driver);
        echo "Connected to Database Two: " . $this->getSecondDataBaseDsn()->database . PHP_EOL;
    }
}