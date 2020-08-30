<?php

namespace App\Service;

use App\Models\Database;
use App\Models\Host;
use App\Repository\DatabaseRepository;

class DbService
{
    private $repository;

    public function __construct(DatabaseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Host $host
     * @return Database
     */
    public function createByHost(Host $host): Database
    {
        return $this->repository->create($this->generateNewName(), $host->project->dbConnection->id);
    }

    /**
     * @return string
     */
    public function generateNewName(): string
    {
        $last = Database::query()->latest()->first();

        $id = $last ? $last->id + 1 : 1;

        return env('PREFIX_TO_CREATE_DB', 'hrdb'). $id;
    }
}
