<?php

namespace App\Repository;

use App\Models\DbConnection;
use Illuminate\Support\Collection;

/**
 * Class DbConnectionRepository
 * @package App\Repository
 */
class DbConnectionRepository extends Repository
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->newQuery()
            ->with(DbConnection::RELATION_SYSTEM)
            ->get();
    }

    public function create(int $systemId, string $login, string $pass, int $port, string $host): DbConnection
    {
        return $this->newQuery()
            ->create([
                DbConnection::FIELD_SYSTEM_ID => $systemId,
                DbConnection::FIELD_HOST => $host,
                DbConnection::FIELD_LOGIN => $login,
                DbConnection::FIELD_PASSWORD => $pass,
                DbConnection::FIELD_PORT => $port,
            ]);
    }

    /**
     * @param int $id
     * @return DbConnection
     */
    public function find(int $id)
    {
        return $this->newQuery()
            ->find($id);
    }
}
