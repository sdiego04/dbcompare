<?php

namespace DBCompare\Task\Steps;

class LoadEnvenvironmentStep implements StepInterface
{
    public function getName(): string
    {
        return 'Load Environment Variables';
    }

    public function getDescription(): string
    {
        return 'Loads environment variables from the .env file.';
    }

    public function execute(): void
    {
        (new \DBCompare\Service\LoadEnvenvironment())->init();
    }
}