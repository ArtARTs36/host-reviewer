<?php

namespace App\Repository;

use App\Models\Database;
use App\Models\DbConnection;
use Illuminate\Support\Collection;

class DatabaseRepository extends Repository
{
    public function getAll(): Collection
    {
        return $this->newQuery()
            ->with(Database::RELATION_DB_CONNECTION . '.' . DbConnection::RELATION_SYSTEM)
            ->get();
    }

    public function create(string $name, int $connectionId): Database
    {
        return $this->newQuery()
            ->create([
                Database::FIELD_NAME => $name,
                Database::FIELD_DB_CONNECTION_ID => $connectionId,
            ]);
    }
}
