<?php


namespace DBCompare\Service;

use DBCompare\Infrastructure\Repository\RepositoryInterface;

class CompareTables
{
    private RepositoryInterface $repositoryOne;
    private RepositoryInterface $repositoryTwo;

    /**
     * @param RepositoryInterface $repositoryOne
     * @param RepositoryInterface $repositoryTwo
     */
    public function __construct(
        RepositoryInterface $repositoryOne, 
        RepositoryInterface $repositoryTwo)
    {
        $this->repositoryOne = $repositoryOne;
        $this->repositoryTwo = $repositoryTwo;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function execute()
    {
        $repositoryOneTables = $this->repositoryOne->getAllTables();
        $repositoryTwoTables = $this->repositoryTwo->getAllTables();
        if(empty($repositoryOneTables) || empty($repositoryTwoTables)){
            throw new \Exception("One of the databases has no tables to compare.");
        }

        $differences = [
            'only_in_db_one' => array_diff($repositoryOneTables, $repositoryTwoTables),
            'only_in_db_two' => array_diff($repositoryTwoTables, $repositoryOneTables),
            'in_both' => array_intersect($repositoryOneTables, $repositoryTwoTables),
        ];

        return $differences;
    }
}