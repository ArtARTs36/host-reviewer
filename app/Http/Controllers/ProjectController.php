<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProject;
use App\Models\Command;
use App\Models\EnvAlias;
use App\Models\HostType;
use App\Models\Project;
use App\Repository\DbConnectionRepository;
use App\Repository\ProjectRepository;
use App\Service\ProjectService;
use App\Service\TypeCommandCreator;
use Illuminate\Contracts\View\View;

class ProjectController extends Controller
{
    private $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }

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
        $envs = EnvAlias::all();

        return view('projects.create', [
            'hostTypes' => HostType::all(),
            'commands' => Command::all(),
            'dbConnections' => app(DbConnectionRepository::class)->getAll(),
            'dbEnvAliases' => $envs->where(EnvAlias::FIELD_SCOPE, EnvAlias::SCOPE_DB),
        ]);
    }

    /**
     * @param StoreProject $request
     * @param TypeCommandCreator $commandCreator
     * @return \Illuminate\Http\RedirectResponse|\Laravel\Lumen\Http\Redirector
     */
    public function store(StoreProject $request, TypeCommandCreator $commandCreator)
    {
        $project = Project::query()->create([
            Project::FIELD_NAME => $request->get(Project::FIELD_NAME),
            Project::FIELD_REMOTE_GIT => $request->get(Project::FIELD_REMOTE_GIT),
            Project::FIELD_IS_NEED_CREATE_DB => (bool) $request->get(StoreProject::FIELD_DB_CREATE),
            Project::FIELD_DB_CONNECTION_ID => $request->get(Project::FIELD_DB_CONNECTION_ID),
        ]);

        if ($request->hasEnvKeys()) {
            $this->service->createEnvKeys($project, $request->getEnvKeys());
        }

        if (($commands = $request->get(StoreProject::FIELD_INSTALL_COMMANDS))) {
            $commandCreator->forInstallEvent($project, $commands);
        }

        if (($commands = $request->get(StoreProject::FIELD_UPDATE_COMMANDS))) {
            $commandCreator->forUpdateEvent($project, $commands);
        }

        return redirect('/');
    }
}
