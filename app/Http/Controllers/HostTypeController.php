<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHostType;
use App\Models\HostType;
use App\Repository\HostTypeRepository;
use Illuminate\View\View;

class HostTypeController extends Controller
{
    private $repository;

    public function __construct(HostTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        return view('hosts.types.index', [
            'types' => $this->repository->getAllWithHosts(),
        ]);
    }

    public function create(): View
    {
        return view('hosts.types.create');
    }

    public function store(StoreHostType $request)
    {
        $this->repository->create($request->get(HostType::FIELD_NAME));

        return redirect('/hosts/types');
    }
}
