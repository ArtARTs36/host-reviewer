<?php

namespace App\Repository;

use App\Models\Command;
use App\Models\HostType;
use App\Models\Project;
use App\Models\TypeCommand;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Class TypeCommandRepository
 * @package App\Repository
 */
class TypeCommandRepository extends Repository
{
    /**
     * @param Project $project
     * @param HostType $hostType
     * @param int $event
     * @param Command $command
     * @return TypeCommand
     */
    public function create(Project $project, HostType $hostType, int $event, Command $command): TypeCommand
    {
        return $this->newQuery()
            ->create([
                TypeCommand::FIELD_PROJECT_ID => $project->id,
                TypeCommand::FIELD_TYPE_ID => $hostType->id,
                TypeCommand::FIELD_EVENT => $event,
                TypeCommand::FIELD_COMMAND_ID => $command->id,
            ]);
    }

    /**
     * @param Project|null $project
     * @param HostType $hostType
     * @return Collection|TypeCommand[]
     */
    public function getAllForInstallEvent(Project $project, HostType $hostType): Collection
    {
        return $this->newQuery()
            ->with(TypeCommand::RELATION_COMMAND)
            ->where(TypeCommand::FIELD_EVENT, TypeCommand::EVENT_INSTALL)
            ->where(TypeCommand::FIELD_PROJECT_ID, $project->id)
            ->where(TypeCommand::FIELD_TYPE_ID, $hostType->id)
            ->get();
    }
}
