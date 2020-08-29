<?php

namespace App\Console\Commands;

use App\Repository\UserRepository;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    protected $name = 'CreateUser';

    protected $signature = 'user:create';

    protected $description = 'Refresh all Hosts';

    public function handle(): void
    {
        /** @var UserRepository $repo */
        $repo = app(UserRepository::class);

        dump(encrypt('kukuepta22'));

        $login = trim($this->ask('Login'));
        $password = trim($this->ask('Password'));

        $repo->create($login, $password);

        $this->comment('Created');
    }
}
