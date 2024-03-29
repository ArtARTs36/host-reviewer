<?php

namespace App\Repository;

use App\Models\Host;

class HostRepository extends Repository
{
    public function create(string $name, string $gitBranch, string $domain): Host
    {
        $host = $this->newQuery()
            ->create([
                Host::FIELD_NAME => $name,
                Host::FIELD_GIT_BRANCH => $gitBranch,
                Host::FIELD_DOMAIN => $domain,
            ]);

        $host->cache();

        return $host;
    }

    public function getAllWithProjects()
    {
        return $this->newQuery()
            ->with(Host::RELATION_PROJECT)
            ->get();
    }

    public function getAllWithAllRelations()
    {
        return $this->newQuery()
            ->with([Host::RELATION_PROJECT, Host::RELATION_TYPE])
            ->get();
    }

    /**
     * @param int $id
     * @param \Closure $or
     * @return Host|mixed
     */
    public function findOr(int $id, \Closure $or)
    {
        $host = $this->newQuery()->find($id);
        if (empty($host)) {
            return $or();
        }

        return $host;
    }
}
