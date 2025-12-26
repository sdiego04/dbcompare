<?php

namespace DBCompare\Infrastructure\DataBase;

class DataBaseDto
{
    public string $host;
    public string $database;
    public string $username;
    public string $password;
    public string $charset;

    public function __construct(
        string $host,
        string $database,
        string $username,
        string $password,
        string $charset = 'utf8mb4'
    ) {
        $this->host = $host;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
        $this->charset = $charset;
    }

    public function convertToArray(): array
    {
        return [
            'host' => $this->host,
            'database' => $this->database,
            'username' => $this->username,
            'password' => $this->password,
            'charset' => $this->charset,
        ];
    }
}