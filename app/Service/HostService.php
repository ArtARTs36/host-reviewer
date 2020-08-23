<?php

namespace App\Service;

use App\Models\Host;
use App\Repository\HostRepository;
use ArtARTs36\EnvEditor\Editor;
use ArtARTs36\EnvEditor\Env;
use ArtARTs36\HostReviewerCore\Handlers\RepositoryInstaller;
use Illuminate\Support\Collection;

class HostService
{
    private $repository;

    private $typeCommandService;

    public function __construct(HostRepository $repository, TypeCommandService $typeCommandService)
    {
        $this->repository = $repository;
        $this->typeCommandService = $typeCommandService;
    }

    /**
     * @param Host $host
     */
    public function install(Host $host)
    {
        $installer = new RepositoryInstaller($host->createGit(), $host->toEntity());

        $installer->install(
            $this->typeCommandService->getEntitiesForInstallEvent($host)
        );
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

    /**
     * @param Host $host
     * @param array $variables
     * @param Env|null $env
     * @return bool
     */
    public function updateEnv(Host $host, array $variables, Env $env = null): bool
    {
        $env = $env ?? $host->envFile();

        foreach ($variables as $key => $value) {
            $env->set($key, $value);
        }

        return Editor::save($env);
    }

    public function all(): Collection
    {
        return $this->repository->getAllWithAllRelations();
    }
}
