@extends('main')

@section('page_name', 'БД: Создать базу')

@section('content')
    <form action="/databases" method="POST">
        <div class="form-group">
            <label for="host-form-create__name">Название</label>
            <input type="text" class="form-control" name="name" id="host-form-create__name">
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Выберите подключение</label>
            <select name="db_connection_id" class="form-control" id="exampleFormControlSelect1">
                @foreach($connections as $connection)
                    <option value="{{ $connection->id }}">
                        {{ $connection->getName() }}
                    </option>
                @endforeach
            </select>
        </div>

        <br/>

        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
