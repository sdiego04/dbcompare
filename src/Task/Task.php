<?php

namespace DBCompare\Task;

class Task
{
    private array $steps = [];

    public function __construct()
    {
        $queuStep = new QueuStep();
        $this->steps = $queuStep->getSteps();
    }

    public function run(): void
    {
        if (empty($this->steps)) {
            echo "No steps to execute." . PHP_EOL;
            return;
        }

        /**
        * Execute each step in sequence
        * @var \DBCompare\Task\Steps\StepInterface $step
        */
        $cont = 1;
        $totalSteps = count($this->steps);
        foreach ($this->steps as $step) {
            echo "Executing step: " . $cont . " of " . $totalSteps . " - " . $step->getName() . PHP_EOL;
            echo $step->getDescription() . PHP_EOL;
            $step->execute();
            echo "Step '" . $step->getName() . "' completed." . PHP_EOL . PHP_EOL;
            $cont++;
        }
    }
}