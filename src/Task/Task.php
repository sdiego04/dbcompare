<?php

namespace DBCompare\Task;

class Task
{
    public static function run(): void
    {
        $QueueStep = new QueueStep();
        $steps = $QueueStep->getSteps();
        if (empty($steps)) {
            echo "No steps to execute." . PHP_EOL;
            return;
        }

        /**
        * Execute each step in sequence
        * @var \DBCompare\Task\Steps\StepInterface $step
        */
        $cont = 1;
        $totalSteps = count($steps);
        foreach ($steps as $step) {
            echo "Executing step: " . $cont . " of " . $totalSteps . " - " . $step->getName() . PHP_EOL;
            echo $step->getDescription() . PHP_EOL;
            $step->execute();
            echo "Step '" . $step->getName() . "' completed." . PHP_EOL . PHP_EOL;
            $cont++;
        }
    }
}