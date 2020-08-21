<?php

namespace App\Repository;

use App\Models\Project;
use Illuminate\Support\Collection;

class ProjectRepository extends Repository
{
    public function getAllWithHosts(): Collection
    {
        return $this->newQuery()
            ->with(Project::RELATION_HOSTS)
            ->get();
    }
}
