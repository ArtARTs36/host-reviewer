<?php

namespace App\Repository;

use App\Models\EnvKey;
use App\Models\Project;

class EnvKeyRepository extends Repository
{
    public function create(int $project, string $key, int $alias): EnvKey
    {
        return $this->newQuery()
            ->create([
                EnvKey::FIELD_PROJECT_ID => $project,
                EnvKey::FIELD_KEY => $key,
                EnvKey::FIELD_ALIAS_ID => $alias,
            ]);
    }
}
