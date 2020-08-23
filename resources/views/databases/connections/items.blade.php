<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">СУБД</th>
        <th scope="col">Хост</th>
        <th scope="col">Порт</th>
        <th scope="col">Логин</th>
        <th scope="col">Пароль</th>
        <th scope="col">Действия</th>
    </tr>
    </thead>
    @foreach($connections as $connection)
        <tr>
            <td>{{ $connection->id }}</td>
            <td>{{ $connection->system->name }}</td>
            <td>{{ $connection->host }}</td>
            <td>{{ $connection->port }}</td>
            <td>{{ $connection->login }}</td>
            <td>{{ $connection->password }}</td>
            <td>

            </td>
        </tr>
    @endforeach
</table>
