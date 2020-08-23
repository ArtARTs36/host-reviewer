<?php

use App\Repository\DbSystemRepository;
use Illuminate\Database\Seeder;

class DbSystemSeeder extends Seeder
{
    public function run(): void
    {
        /** @var DbSystemRepository $repo */
        $repo = app(DbSystemRepository::class);

        //

        $repo->create('MySQL', 'mysql');
        $repo->create('PgSQL', 'pgsql');
    }
}
