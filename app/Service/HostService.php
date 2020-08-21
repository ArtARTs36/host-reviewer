<?php

namespace App\Service;

use App\Models\Host;
use App\Repository\HostRepository;
use ArtARTs36\HostReviewerCore\Handlers\RepositoryInstaller;
use Illuminate\Support\Collection;

class HostService
{
    private $repository;

    public function __construct(HostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Host $host
     */
    public function install(Host $host)
    {
        $installer = new RepositoryInstaller($host->createGit(), $host->toEntity());

        $installer->install();
    }

    /**
     * @param Host $host
     * @return bool
     */
    public function pull(Host $host): bool
    {
        $git = $host->createGit();

        return $git->pull();
    }

    /**
     * @param Host $host
     * @return bool
     * @throws \Exception
     */
    public function delete(Host $host): bool
    {
        $host->createGitAction()->delete();

        return $host->delete();
    }

    /**
     * @param int $id
     * @return Host
     */
    public function find(int $id): Host
    {
        return $this->repository->findOr($id, function () {
            abort(404);
        });
    }

    public function all(): Collection
    {
        return $this->repository->getAllWithAllRelations();
    }
}
