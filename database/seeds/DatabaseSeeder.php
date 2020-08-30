<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(HostTypeSeeder::class);
        $this->call(DbSystemSeeder::class);
        $this->call(CommandSeeder::class);
        $this->call(EnvAliasSeeder::class);
    }
}
