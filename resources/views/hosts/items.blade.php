<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Домен</th>
        <th scope="col">Проект</th>
        <th scope="col">Тип</th>
        <th scope="col">Git-ветка</th>
        <th scope="col">Действия</th>
    </tr>
    </thead>
    @foreach($hosts as $host)
        <tr>
            <td>{{ $host->id }}</td>
            <td>{{ $host->domain }}</td>
            <td>{{ $host->project->name }}</td>
            <td>{{ $host->type->name }}</td>
            <td>{{ $host->git_branch }}</td>
            <td>
                <a href="/hosts/{{ $host->id }}/env">env</a>
                <a href="/hosts/{{ $host->id }}/pull">pull</a>
                <a href="/hosts/{{ $host->id }}/destroy">delete</a>
            </td>
        </tr>
    @endforeach
</table>
