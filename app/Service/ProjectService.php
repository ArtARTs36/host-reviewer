<?php

namespace App\Service;

use App\Models\Project;
use App\Repository\EnvKeyRepository;
use Illuminate\Support\Collection;

class ProjectService
{
    private $envKeyRepository;

    public function __construct(EnvKeyRepository $envKeyRepository)
    {
        $this->envKeyRepository = $envKeyRepository;
    }

    /**
     * @param Project $project
     * @param array $envs
     * @return Collection
     */
    public function createEnvKeys(Project $project, array $envs): Collection
    {
        $keys = collect();

        foreach ($envs as $env) {
            $keys->push($this->envKeyRepository->create($project->id, $env['key'], $env['alias_id']));
        }

        return $keys;
    }
}
