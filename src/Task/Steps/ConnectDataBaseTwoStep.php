<?php

namespace DBCompare\Task\Steps;

class ConnectDataBaseTwoStep implements StepInterface
{
    use \DBCompare\Helpers\DataBaseHelper;

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Connect to Database Two';
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Establishes a connection to the second database using provided credentials.';
    }

    /**
     * Executes the step to connect to the second database.
     */
    public function execute(): void
    {
        $driver = \DBCompare\Service\LoadDriverByName::execute(
            getenv('DB_COMPARE_DB_DRIVER_SECONDARY'),
            $this->getSecondDataBaseDsn()
        );
        $driver->connect();
        echo "Connected to Database Two: " . $this->getSecondDataBaseDsn()->database . PHP_EOL;
    }
}