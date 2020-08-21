@extends('main')

@section('page_name', 'Создать проект')

@section('content')
    <form action="/projects" method="POST">
        <div class="form-group">
            <label for="host-form-create__domain">Название</label>
            <input type="text" class="form-control" name="name" id="host-form-create__domain">
        </div>

        <div class="form-group">
            <label for="host-form-create__remote_git">Url к Git-Репозиторию</label>
            <input type="text" class="form-control" name="remote_git" id="host-form-create__remote_git">
        </div>

        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
