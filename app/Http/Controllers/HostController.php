<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExecuteRawCommand;
use App\Http\Requests\StoreHost;
use App\Models\Command;
use App\Models\Host;
use App\Models\HostType;
use App\Models\Project;
use App\Service\HostService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HostController extends Controller
{
    private $service;

    public function __construct(HostService $service)
    {
        $this->service = $service;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('hosts.index', [
            'hosts' => $this->service->all(),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('hosts.create', [
            'pathToHosts' => env('PATH_TO_HOSTS'),
            'projects' => Project::all(),
            'types' => HostType::all(),
        ]);
    }

    /**
     * @param StoreHost $request
     * @return RedirectResponse|\Laravel\Lumen\Http\Redirector
     */
    public function store(StoreHost $request)
    {
        /** @var Host $host */
        $host = Host::query()->create($request->all());

        if ($request->get(StoreHost::FIELD_INSTALL)) {
            $this->service->install($host);
        }

        return redirect('/');
    }

    public function pull(int $host): View
    {
        return $this->service->pull($this->service->find($host)) ?
            $this->success('Хост успешно обновлен') :
            $this->danger('Не удалось обновить хост');
    }

    /**
     * @param int $host
     * @return View
     */
    public function editEnv(int $host): View
    {
        $host = $this->service->find($host);

        return view('hosts.env', [
            'host' => $host,
            'variables' => $host->envExists() ? $host->envFile()->getVariables() : null,
        ]);
    }

    /**
     * @param Request $request
     * @param int $host
     * @return RedirectResponse
     */
    public function updateEnv(Request $request, int $host): RedirectResponse
    {
        /** @var Host $host */
        $host = Host::query()->find($host);

        $this->service->updateEnv($host, $request->get('variables'));

        return redirect('/hosts/');
    }

    /**
     * @param int $host
     * @return View
     * @throws \Exception
     */
    public function destroy(int $host): View
    {
        $this->service->deleteById($host);

        return $this->success('Хост удален');
    }

    /**
     * @param int $host
     * @return View
     */
    public function show(int $host): View
    {
        return view('hosts.show', [
            'host' => $this->service->find($host),
            'commands' => Command::all(),
        ]);
    }

    /**
     * @param int $host
     * @param ExecuteRawCommand $request
     * @return View
     */
    public function rawCommand(int $host, ExecuteRawCommand $request): View
    {
        return view('terminal', [
            'text' => $this->service->executeRawCommand(
                $this->service->find($host),
                $request->shell
            ),
        ]);
    }
}
