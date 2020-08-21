<?php

namespace App\Service;

use App\Models\Host;
use ArtARTs36\GitHandler\Action;
use ArtARTs36\HostReviewerCore\Handlers\RepositoryInstaller;

class HostService
{
    public function install(Host $host)
    {
        $installer = new RepositoryInstaller($host->createGit(), $host->toEntity());

        $installer->install();
    }

    public function pull(Host $host): bool
    {
        $git = $host->createGit();

        return $git->pull();
    }

    public function delete(Host $host)
    {
        $host->createGitAction()->delete();

        $host->delete();
    }
}
