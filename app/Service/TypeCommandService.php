<?php

namespace App\Service;

use App\Models\Host;
use App\Models\HostType;
use App\Models\Project;
use App\Models\TypeCommand;
use App\Repository\TypeCommandRepository;
use ArtARTs36\HostReviewerCore\Entities\Command;

/**
 * Class TypeCommandService
 * @package App\Service
 */
class TypeCommandService
{
    /** @var TypeCommandRepository */
    private $repository;

    /**
     * TypeCommandService constructor.
     * @param TypeCommandRepository $repository
     */
    public function __construct(TypeCommandRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Host $host
     * @return Command[]
     */
    public function getEntitiesForInstallEvent(Host $host): array
    {
        return $this->repository->getAllForInstallEvent($host->project, $host->type)
            ->map(function (TypeCommand $command) {
                return $command->command->toEntity();
            })->all();
    }
}
