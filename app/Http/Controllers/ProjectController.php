<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProject;
use App\Models\Command;
use App\Models\HostType;
use App\Models\Project;
use App\Repository\ProjectRepository;
use Illuminate\Contracts\View\View;

class ProjectController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('projects.index', [
            'projects' => app(ProjectRepository::class)->getAllWithHosts(),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('projects.create', [
            'hostTypes' => HostType::all(),
            'commands' => Command::all(),
        ]);
    }

    /**
     * @param StoreProject $request
     * @return \Illuminate\Http\RedirectResponse|\Laravel\Lumen\Http\Redirector
     */
    public function store(StoreProject $request)
    {
        Project::query()->create($request->all());

        return redirect('/');
    }
}
