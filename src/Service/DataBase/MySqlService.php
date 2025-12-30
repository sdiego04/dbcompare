<?php

namespace DBCompare\Service\DataBase;

use DBCompare\Infrastructure\Repository\MySql\MySqlRepository;

class MySqlService extends DataBaseServiceBase
{ 
    /**
     * Gets the repository for the MySQL database service.
     *
     * @return \DBCompare\Infrastructure\Repository\RepositoryInterface The repository instance.
     */
    public function getRepository(): \DBCompare\Infrastructure\Repository\RepositoryInterface
    {
        return new MySqlRepository($this->driver);
    }   

}