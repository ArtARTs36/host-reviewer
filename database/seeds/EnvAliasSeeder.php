<?php

use App\Models\EnvAlias;
use Illuminate\Database\Seeder;

class EnvAliasSeeder extends Seeder
{
    public function run(): void
    {
        $this->create('СУБД', EnvAlias::SLUG_DB_SYSTEM);
        $this->create('Подключение к БД: Хост', EnvAlias::SLUG_DB_HOST);
        $this->create('Подключение к БД: Порт', EnvAlias::SLUG_DB_PORT);
        $this->create('Подключение к БД: Пользователь', EnvAlias::SLUG_DB_USER);
        $this->create('Подключение к БД: Пароль', EnvAlias::SLUG_DB_PASSWORD);
        $this->create('Название БД', EnvAlias::SLUG_DB_NAME);
    }

    private function create(string $title, string $slug): EnvAlias
    {
        return EnvAlias::query()->create([
            EnvAlias::FIELD_TITLE => $title,
            EnvAlias::FIELD_SLUG => $slug,
        ]);
    }
}
