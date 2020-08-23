<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDatabase;
use App\Models\Database;
use App\Models\DbConnection;
use App\Repository\DatabaseRepository;
use App\Repository\DbConnectionRepository;
use ArtARTs36\DbCreator\Creator;
use Illuminate\View\View;

class DatabaseController extends Controller
{
    private $repository;

    private $dbConnectionRepository;

    public function __construct(
        DatabaseRepository $repository,
        DbConnectionRepository $dbConnectionRepository
    ) {
        $this->repository = $repository;
        $this->dbConnectionRepository = $dbConnectionRepository;
    }

    public function index(): \Illuminate\Contracts\View\View
    {
        return view('databases.index', [
            'databases' => $this->repository->getAll(),
        ]);
    }

    public function create()
    {
        return view('databases.create', [
            'connections' => $this->dbConnectionRepository->getAll(),
        ]);
    }

    public function store(StoreDatabase $request)
    {
        $connection = $this->dbConnectionRepository->find($request->get(Database::FIELD_DB_CONNECTION_ID));

        $dbName = $request->get(Database::FIELD_NAME);

        if (!Creator::create(
            $connection->toAccess(),
            $connection->system->key,
            $dbName
        )) {
            return $this->danger("Не удалось создать базу данных: {$dbName}");
        }

        $this->repository->create(...$request->onlyRulesValues());

        return $this->success('База даннах создана');
    }
}
