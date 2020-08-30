<?php

use App\Repository\CommandRepository;
use Illuminate\Database\Seeder;

class CommandSeeder extends Seeder
{
    public function run(): void
    {
        /** @var CommandRepository $repo */
        $repo = app(CommandRepository::class);

        //

        $repo->create('Установка PHP зависимостей', 'composer install');
        $repo->create('Установка PHP зависимостей', 'composer install --no-dev');
        $repo->create('Обновление PHP классов', 'composer dump-autoload -o');

        //

        $repo->create('Установка js зависимостей', 'yarn install');
        $repo->create('Создание .env', 'cp .env.docker.example .env');
    }
}
