@extends('main')

@section('page_name', 'БД: Создать подключение')

@section('content')
    <form action="/databases/connections" method="POST">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Выберите СУБД</label>
            <select name="system_id" class="form-control" id="exampleFormControlSelect1">
                @foreach($systems as $system)
                    <option value="{{ $system->id }}">{{ $system->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="host-form-create__host">Хост</label>
            <input type="text" class="form-control" name="host" id="host-form-create__host"
                value="127.0.0.1"
            >
        </div>

        <div class="form-group">
            <label for="host-form-create__port">Порт</label>
            <input type="text" class="form-control" name="port" id="host-form-create__port">
        </div>

        <div class="form-group">
            <label for="host-form-create__login">Логин</label>
            <input type="text" class="form-control" name="login" id="host-form-create__login">
        </div>

        <div class="form-group">
            <label for="host-form-create__port">Пароль</label>
            <input type="text" class="form-control" name="password" id="host-form-create__password">
        </div>

        <br/>

        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
