<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommand;
use App\Models\Command;
use App\Service\CommandService;
use Illuminate\View\View;

/**
 * Class CommandController
 * @package App\Http\Controllers
 */
class CommandController extends Controller
{
    /** @var CommandService */
    private $service;

    /**
     * CommandController constructor.
     * @param CommandService $service
     */
    public function __construct(CommandService $service)
    {
        $this->service = $service;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('commands.index', [
            'commands' => Command::all(),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('commands.create');
    }

    /**
     * @param StoreCommand $request
     * @return \Illuminate\Http\RedirectResponse|\Laravel\Lumen\Http\Redirector
     */
    public function store(StoreCommand $request)
    {
        $this->service->createOfRequest($request);

        return redirect('/commands');
    }
}
