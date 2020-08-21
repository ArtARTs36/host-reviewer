<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHost;
use App\Models\Host;
use App\Models\HostType;
use App\Models\Project;
use App\Repository\HostRepository;
use App\Service\HostService;
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
     * @return \Illuminate\Http\RedirectResponse|\Laravel\Lumen\Http\Redirector
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

    public function pull(int $host)
    {
        $host = Host::query()->find($host);

        return response([
            'result' => $this->service->pull($host) ? 'Хост обновлен' : 'Хост НЕ обновлен',
        ]);
    }

    /**
     * @param int $host
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Exception
     */
    public function destroy(int $host)
    {
        $host = $this->service->find($host);

        $this->service->delete($host);

        return response([
            'result' => 'Хост удален',
        ]);
    }
}
