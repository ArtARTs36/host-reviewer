<?php

namespace App\Service;

use App\Models\EnvAlias;
use App\Models\Host;
use App\Repository\EnvAliasRepository;
use ArtARTs36\EnvEditor\Editor;

class EnvService
{
    public static function installDatabase(Host $host, string $database): bool
    {
        $env = $host->envFile();

        /** @var EnvAliasRepository $repo */
        $repo = app(EnvAliasRepository::class);

        /** @var EnvAlias[] $aliases */
        $aliases = $repo->findByScopeAndProject(EnvAlias::SCOPE_DB, $host->project->id)
            ->pluck('key', EnvAlias::FIELD_SLUG);

        //

        $conn = $host->project->dbConnection;

        $env->set($aliases[EnvAlias::SLUG_DB_SYSTEM], $conn->system->key);
        $env->set($aliases[EnvAlias::SLUG_DB_HOST], $conn->host);
        $env->set($aliases[EnvAlias::SLUG_DB_PORT], $conn->port);
        $env->set($aliases[EnvAlias::SLUG_DB_NAME], $database);
        $env->set($aliases[EnvAlias::SLUG_DB_USER], $conn->login);
        $env->set($aliases[EnvAlias::SLUG_DB_PASSWORD], $conn->password);

        return Editor::save($env);
    }
}
