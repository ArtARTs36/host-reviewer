<?php

use App\Repository\HostTypeRepository;
use Illuminate\Database\Seeder;

class HostTypeSeeder extends Seeder
{
    public function run(): void
    {
        /** @var HostTypeRepository $repo */
        $repo = app(HostTypeRepository::class);

        //

        $repo->create('dev');
        $repo->create('prod');
        $repo->create('test');
    }
}
