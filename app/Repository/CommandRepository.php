<?php

namespace App\Repository;

use App\Models\Command;

/**
 * Class CommandRepository
 * @package App\Repository
 */
class CommandRepository extends Repository
{
    /**
     * @param string $description
     * @param string $shell
     * @return Command
     */
    public function create(string $description, string $shell): Command
    {
        return $this->newQuery()
            ->create([
                Command::FIELD_DESCRIPTION => $description,
                Command::FIELD_SHELL => $shell,
            ]);
    }
}
