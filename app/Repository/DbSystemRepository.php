<?php

namespace App\Repository;

use App\Models\DbSystem;

/**
 * Class DbSystemRepository
 * @package App\Repository
 */
class DbSystemRepository extends Repository
{
    /**
     * @param string $name
     * @param string $key
     * @return DbSystem
     */
    public function create(string $name, string $key): DbSystem
    {
        return $this->newQuery()
            ->create([
                DbSystem::FIELD_NAME => $name,
                DbSystem::FIELD_KEY => $key,
            ]);
    }
}
