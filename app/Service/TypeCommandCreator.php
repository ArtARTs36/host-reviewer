<?php

namespace App\Service;

use App\Models\Command;
use App\Models\HostType;
use App\Models\Project;
use App\Models\TypeCommand;
use App\Repository\TypeCommandRepository;
use Illuminate\Support\Collection;

/**
 * Class TypeCommandCreator
 * @package App\Service
 */
class TypeCommandCreator
{
    /** @var Collection */
    private $hostTypes;

    /** @var Collection */
    private $commands;

    /** @var TypeCommandRepository */
    private $repo;

    /**
     * TypeCommandCreator constructor.
     * @param TypeCommandRepository $repo
     */
    public function __construct(TypeCommandRepository $repo)
    {
        $this->hostTypes = HostType::all()->pluck(null, 'id');
        $this->commands = Command::all()->pluck(null, 'id');
        $this->repo = $repo;
    }

    /**
     * @param Project $project
     * @param int[] $commands
     * @return Collection
     */
    public function forInstallEvent(Project $project, array $commands): Collection
    {
        return $this->applyEventCommands($project, TypeCommand::EVENT_INSTALL, $commands);
    }

    /**
     * @param Project $project
     * @param int[] $commands
     * @return Collection
     */
    public function forUpdateEvent(Project $project, array $commands): Collection
    {
        return $this->applyEventCommands($project, TypeCommand::EVENT_UPDATE, $commands);
    }

    /**
     * @param Project $project
     * @param int $event
     * @param array $commands
     * @return Collection
     */
    private function applyEventCommands(
        Project $project,
        int $event,
        array $commands
    ): Collection {
        $cmd = collect();

        foreach ($commands as $hostType => $cmds) {
            foreach ($cmds as $installCommand) {
                $installCommand = (int) $installCommand;

                if (empty($this->hostTypes[$hostType]) || empty($this->commands[$installCommand])) {
                    continue;
                }

                $cmd[] = $this->repo->create(
                    $project,
                    $this->hostTypes[$hostType],
                    $event,
                    $this->commands[$installCommand]
                );
            }
        }

        return $cmd;
    }
}
