<?php

namespace DBCompare\Task;

use DBCompare\Task\Steps\StepInterface;

class QueueStep
{
    // List of step class names to be executed in order
    private array $steps = [
        \DBCompare\Task\Steps\LoadEnvenvironmentStep::class,
        \DBCompare\Task\Steps\CheckDataBaseDriversStep::class,
        \DBCompare\Task\Steps\ConnectDataBaseOneStep::class,
        \DBCompare\Task\Steps\ConnectDataBaseTwoStep::class,
        \DBCompare\Task\Steps\CompareTableStep::class,
        \DBCompare\Task\Steps\CompareColumnStep::class,
    ];

    /**
     * Get instances of the steps to be executed.
     *
     * @return StepInterface[]
     */
    public function getSteps(): array
    {
        $instances = [];
        foreach ($this->steps as $stepClass) {
            if (class_exists($stepClass)) {
                $instances[] = new $stepClass();
            }else{
                throw new \Exception("Step class {$stepClass} does not exist.");
            }
        }
        return $instances;
    }
}