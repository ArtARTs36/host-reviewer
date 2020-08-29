<?php

namespace App\Console\Commands;

use ArtARTs36\EnvEditor\Editor;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class KeyGenerate extends Command
{
    protected $name = 'KeyGenerate';

    protected $signature = 'key:generate';

    protected $description = 'Key Generate';

    public function handle(): void
    {
        $key = Str::random(32);

        Editor::load(app()->basePath('.env'))
            ->set('APP_KEY', $key)
            ->save();
    }
}
