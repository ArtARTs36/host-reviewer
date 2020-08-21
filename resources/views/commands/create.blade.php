@extends('main')

@section('page_name', 'Создать команду')

@section('content')
    <form action="/commands" method="POST">
        <div class="form-group">
            <label for="host-form-create__domain">Описание</label>
            <input type="text" class="form-control" name="description" id="command-form-create__description">
        </div>

        <div class="form-group">
            <label for="host-form-create__remote_git">Shell</label>
            <input type="text" class="form-control" name="shell" id="command-form-create__shell">
        </div>

        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
