<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Название</th>
        <th scope="col">Хосты</th>
    </tr>
    </thead>
    @foreach($types as $type)
        <tr>
            <td>{{ $type->id }}</td>
            <td>{{ $type->name }}</td>
            <td>{{ $type->hosts->count() }}</td>
        </tr>
    @endforeach
</table>
