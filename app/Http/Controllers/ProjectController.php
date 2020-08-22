<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProject;
use App\Models\Command;
use App\Models\HostType;
use App\Models\Project;
use App\Repository\ProjectRepository;
use App\Service\TypeCommandCreator;
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
     * @param TypeCommandCreator $commandCreator
     * @return \Illuminate\Http\RedirectResponse|\Laravel\Lumen\Http\Redirector
     */
    public function store(StoreProject $request, TypeCommandCreator $commandCreator)
    {
        $project = Project::query()->create($request->all());

        if (($commands = $request->get(StoreProject::FIELD_INSTALL_COMMANDS))) {
            $commandCreator->forInstallEvent($project, $commands);
        }

        if (($commands = $request->get(StoreProject::FIELD_UPDATE_COMMANDS))) {
            $commandCreator->forUpdateEvent($project, $commands);
        }

        return redirect('/');
    }
}
