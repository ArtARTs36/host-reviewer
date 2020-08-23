<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDbConnection;
use App\Models\DbConnection;
use App\Models\DbSystem;
use App\Repository\DbConnectionRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DbConnectionController
{
    private $repository;

    public function __construct(DbConnectionRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        return view('databases.connections.index', [
           'connections' => $this->repository->getAll(),
        ]);
    }

    public function create(): View
    {
        return view('databases.connections.create', [
            'systems' => DbSystem::all(),
        ]);
    }

    public function store(StoreDbConnection $request)
    {
        $fields = [
            DbConnection::FIELD_SYSTEM_ID,
            DbConnection::FIELD_LOGIN,
            DbConnection::FIELD_PASSWORD,
            DbConnection::FIELD_PORT,
            DbConnection::FIELD_HOST,
        ];

        $this->repository->create(...$request->onlyValues($fields));

        return redirect('/databases/connections');
    }
}
