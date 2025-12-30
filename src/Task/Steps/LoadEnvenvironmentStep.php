<?php

namespace DBCompare\Task\Steps;

class LoadEnvenvironmentStep implements StepInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'Load Environment Variables';
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return 'Loads environment variables from the .env file.';
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        (new \DBCompare\Service\LoadEnvenvironment())->init();
    }
}