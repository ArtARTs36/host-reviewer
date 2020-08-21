<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Описание</th>
        <th scope="col">Скрипт</th>
        <th scope="col">Действия</th>
    </tr>
    </thead>
    @foreach($commands as $command)
        <tr>
            <td>{{ $command->id }}</td>
            <td>{{ $command->description }}</td>
            <td>{{ $command->shell }}</td>
            <td>
                <a>delete</a>
            </td>
        </tr>
    @endforeach
</table>
