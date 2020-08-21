<?php

namespace App\Repository;

use App\Models\Ip;

class IpRepository extends Repository
{
    public function createBlocked(string $ip, int $host): Ip
    {
        return $this->newQuery()
            ->create([
                Ip::FIELD_IP => $ip,
                Ip::FIELD_ACCESS => false,
                Ip::FIELD_HOST_ID => $host,
            ]);
    }
}
