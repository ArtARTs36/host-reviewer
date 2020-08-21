<?php

namespace App\Console\Commands;

use App\Models\Host;
use App\Repository\HostRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class HostsRefresh extends Command
{
    protected $name = 'HostsRefresh';

    protected $signature = 'hosts:refresh';

    protected $description = 'Refresh all Hosts';

    public function handle()
    {
        /** @var Host[]|Collection $hosts */
        $hosts = app(HostRepository::class)->getAllWithAllRelations();

        foreach ($hosts as $host) {
            $host->cache();
        }
    }
}
