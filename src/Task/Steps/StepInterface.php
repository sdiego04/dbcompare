<?php

namespace DBCompare\Task\Steps;

interface StepInterface
{
    /**
     * Get the name of the step.
     */
    public function getName(): string;

    /**
     * Get the description of the step.
     */
    public function getDescription(): string;

    /**
     * Execute the step with the given data.
     *
     */
    public function execute():void;
}