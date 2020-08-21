<?php

namespace App\Repository;

use App\Models\HostType;
use Illuminate\Support\Collection;

class HostTypeRepository extends Repository
{
    /**
     * @return Collection
     */
    public function getAllWithHosts(): Collection
    {
        return $this->newQuery()
            ->with(HostType::RELATION_HOSTS)
            ->get();
    }

    /**
     * @param string $name
     * @return HostType
     */
    public function create(string $name): HostType
    {
        return $this->newQuery()
            ->create([
                HostType::FIELD_NAME => $name,
            ]);
    }
}
