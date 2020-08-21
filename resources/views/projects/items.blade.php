<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Название</th>
        <th scope="col">Репозиторий</th>
        <th scope="col">Хосты</th>
    </tr>
    </thead>
    @foreach($projects as $project)
        <tr>
            <td>{{ $project->id }}</td>
            <td>{{ $project->name }}</td>
            <td>{{ $project->remote_git }}</td>
            <td>{{ $project->hosts->count() }}</td>
        </tr>
    @endforeach
</table>
