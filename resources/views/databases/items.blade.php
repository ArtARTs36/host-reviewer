<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">СУБД</th>
        <th scope="col">Название</th>
        <th scope="col">Подключение</th>
        <th scope="col">Действия</th>
    </tr>
    </thead>
    @foreach($databases as $db)
        <tr>
            <td>{{ $db->id }}</td>
            <td>{{ $db->dbConnection->system->name }}</td>
            <td>{{ $db->name }}</td>
            <td>{{ $db->dbConnection->id }}</td>
            <td>

            </td>
        </tr>
    @endforeach
</table>
