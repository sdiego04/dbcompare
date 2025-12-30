<?php

namespace DBCompare\Service;

class OutPutJsonFile
{
    public static function execute(): array
    {
        $filePath = 'db_compare_result.json';
        if (!file_exists($filePath)) {
            throw new \Exception("JSON file not found: " . $filePath);
        }

        $jsonContent = file_get_contents($filePath);
        $data = json_decode($jsonContent, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Error decoding JSON file: " . json_last_error_msg());
        }

        return $data;
    }
}