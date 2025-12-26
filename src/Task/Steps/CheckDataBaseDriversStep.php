<?php


namespace DBCompare\Task\Steps;

class CheckDataBaseDriversStep implements StepInterface
{
    public function getName(): string
    {
        return 'Check Database Drivers';
    }

    public function getDescription(): string
    {
        return 'Checks if the required database drivers are available.';
    }

    public function execute(): void
    {
        $checkDriversService = new \DBCompare\Service\CheckDataBaseDrivers();
        if (!$checkDriversService->execute()) {
            throw new \RuntimeException("One or both of the specified database drivers are not available.");
        }
    }
}