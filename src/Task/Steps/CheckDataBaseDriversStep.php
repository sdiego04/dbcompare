<?php


namespace DBCompare\Task\Steps;

class CheckDataBaseDriversStep implements StepInterface
{
    /**
     * Returns the name of the step.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Check Database Drivers';
    }

    /**
     * Returns the description of the step.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return 'Checks if the required database drivers are available.';
    }

    /**
     * Executes the step.
     *
     * @throws \RuntimeException if the required database drivers are not available.
     */
    public function execute(): void
    {
        $checkDriversService = new \DBCompare\Service\CheckDataBaseDrivers();
        if (!$checkDriversService->execute()) {
            throw new \RuntimeException("One or both of the specified database drivers are not available.");
        }
    }
}