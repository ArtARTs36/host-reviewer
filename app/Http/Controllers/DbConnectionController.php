<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDbConnection;
use App\Models\DbConnection;
use App\Models\DbSystem;
use App\Repository\DbConnectionRepository;
use App\Service\DbConnectionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DbConnectionController extends Controller
{
    private $repository;

    private $service;

    public function __construct(DbConnectionRepository $repository, DbConnectionService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
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

        $connection = $this->repository->make(...$request->onlyValues($fields));

        $error = '';

        if (!$this->service->checkRealConnection($connection, $error)) {
            return $this->danger('Не удалось создать подключение: '. $error);
        }

        $connection->save();

        return redirect('/databases/connections');
    }
}
