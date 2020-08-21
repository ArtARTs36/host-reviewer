<?php

namespace App\Pages;

use App\Models\Host;
use App\Repository\ProjectRepository;
use Illuminate\View\View;

class Home
{
    public function view(): View
    {
        return view('home', [
            'projects' => app(ProjectRepository::class)->getAllWithHosts(),
            'hosts' => Host::all(),
        ]);
    }
}
