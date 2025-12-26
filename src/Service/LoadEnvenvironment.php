<?php

namespace DBCompare\Service;

use DBCompare\Infrastructure\DataBase\EnumDataBase;
use Dotenv\Dotenv;

class LoadEnvenvironment
{   
    public function init()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . "/../..");
        $envs = $dotenv->load();
        if(empty($envs)){
            throw new \Exception("Error loading .env file");
        }

        foreach ($envs as $key => $value) {
            if (defined(EnumDataBase::class . '::' . strtoupper($key))) {
                $_ENV[$key] = $value;
                putenv("$key=$value");
            }
        }

        foreach (EnumDataBase::cases() as $enumCase) {
            $key = $enumCase->name;
            if (!isset($_ENV[$key]) || $_ENV[$key] === false) {
                throw new \Exception("Environment variable '$key' is not set.");
            }
        }
    }
}