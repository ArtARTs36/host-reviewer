<?php

namespace App\Repository;

use App\Models\EnvAlias;

class EnvAliasRepository extends Repository
{
    public function create(string $title, string $slug, string $scope): EnvAlias
    {
        return EnvAlias::query()->create([
            EnvAlias::FIELD_TITLE => $title,
            EnvAlias::FIELD_SLUG => $slug,
            EnvAlias::FIELD_SCOPE => $scope,
        ]);
    }
}
