<?php

namespace DBCompare\Service;

class StoreJsonFile
{
    public static function execute($data): void
    {
        $data = (array)$data;
        $jsonContent = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents('db_compare_result.json', $jsonContent);
    }
}