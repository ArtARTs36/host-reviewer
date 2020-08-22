<?php

namespace App\Repository;

use App\Models\Command;
use App\Models\HostType;
use App\Models\Project;
use App\Models\TypeCommand;

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
}
