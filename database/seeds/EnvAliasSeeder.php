<?php

use App\Models\EnvAlias;
use App\Repository\EnvAliasRepository;
use Illuminate\Database\Seeder;

class EnvAliasSeeder extends Seeder
{
    public function run(): void
    {
        $this->create('СУБД', EnvAlias::SLUG_DB_SYSTEM);
        $this->create('Название БД', EnvAlias::SLUG_DB_NAME);
        $this->create('Подключение к БД: Хост', EnvAlias::SLUG_DB_HOST);
        $this->create('Подключение к БД: Порт', EnvAlias::SLUG_DB_PORT);
        $this->create('Подключение к БД: Пользователь', EnvAlias::SLUG_DB_USER);
        $this->create('Подключение к БД: Пароль', EnvAlias::SLUG_DB_PASSWORD);
    }

    private function create(string $title, string $slug, string $scope = EnvAlias::SCOPE_DB): EnvAlias
    {
        return app(EnvAliasRepository::class)->create($title, $slug, $scope);
    }
}
