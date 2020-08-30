<?php

namespace App\Service;

use App\Models\Command;
use App\Models\Database;
use App\Models\Host;
use App\Repository\HostRepository;
use ArtARTs36\DbCreator\Access;
use ArtARTs36\EnvEditor\Editor;
use ArtARTs36\EnvEditor\Env;
use ArtARTs36\HostReviewerCore\Handlers\ProjectInstaller;
use ArtARTs36\HostReviewerCore\Handlers\RepositoryInstaller;
use ArtARTs36\HostReviewerCore\Support\Commander;
use ArtARTs36\ShellCommand\ShellCommand;
use Illuminate\Support\Collection;

class HostService
{
    private $repository;

    private $typeCommandService;

    private $dbService;

    public function __construct(HostRepository $repository, TypeCommandService $typeCommandService, DbService $dbService)
    {
        $this->repository = $repository;
        $this->typeCommandService = $typeCommandService;
        $this->dbService = $dbService;
    }

    /**
     * @param Host $host
     */
    public function install(Host $host)
    {
        $installer = new ProjectInstaller($host->createGit(), $host->toEntity());

        $installer->install(
            $this->typeCommandService->getEntitiesForInstallEvent($host)
        );

        if ((bool) $host->project->is_need_create_db === true) {
            $conn = $host->project->dbConnection;
            $access = Access::make($conn->login, $conn->password, $conn->port, $conn->host);
            $db = $this->dbService->createByHost($host);

            $installer->installDatabase($conn->system->key, $db->name, $access);
        }
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
     * @param int $host
     * @return bool
     * @throws \Exception
     */
    public function deleteById(int $host): bool
    {
        return $this->delete($this->find($host));
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

    public function executeRawCommand(Host $host, string $command)
    {
        $command = Commander::prepare(
            new \ArtARTs36\HostReviewerCore\Entities\Command($command),
            $host->toEntity()
        );

        $shell = ShellCommand::getInstanceWithMoveDir($host->path, '')
            ->addParameter($command);

        return $shell->getShellResult();
    }

    public function executeCommand(Host $host, Command $command)
    {
        return $this->executeRawCommand($host, $command->shell);
    }
}
