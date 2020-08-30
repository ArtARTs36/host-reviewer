<?php

namespace App\Repository;

use App\Models\EnvAlias;
use App\Models\EnvKey;
use Illuminate\Database\Eloquent\Collection;

class EnvAliasRepository extends Repository
{
    /**
     * @param string $scope
     * @param int $project
     * @return Collection|EnvAlias[]
     */
    public function findByScopeAndProject(string $scope, int $project): Collection
    {
        return $this->newQuery()
            ->with([EnvAlias::RELATION_KEYS => function($query) use ($project) {
                $query->where(EnvKey::FIELD_PROJECT_ID, $project);
            }])
            ->where(EnvAlias::FIELD_SCOPE, $scope)
            ->get();
    }

    public function create(string $title, string $slug, string $scope): EnvAlias
    {
        return EnvAlias::query()->create([
            EnvAlias::FIELD_TITLE => $title,
            EnvAlias::FIELD_SLUG => $slug,
            EnvAlias::FIELD_SCOPE => $scope,
        ]);
    }
}
