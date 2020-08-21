<?php

namespace App\Service;

use App\Http\Requests\StoreCommand;
use App\Models\Command;
use App\Repository\CommandRepository;

class CommandService
{
    /** @var CommandRepository */
    private $repository;

    /**
     * CommandService constructor.
     * @param CommandRepository $repository
     */
    public function __construct(CommandRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param StoreCommand $request
     * @return Command
     */
    public function createOfRequest(StoreCommand $request): Command
    {
        return $this->repository->create(
            ...array_values($request->only(Command::FIELD_DESCRIPTION, Command::FIELD_SHELL))
        );
    }
}
