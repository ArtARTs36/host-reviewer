@extends('main')

@section('page_name', 'Создать тип хоста')

@section('content')
    <form action="/hosts/types" method="POST">
        <div class="form-group">
            <label for="host-type-form-create__domain">Название</label>
            <input type="text" class="form-control" name="name" id="host-type-form-create__domain">
        </div>

        <button type="submit" class="btn btn-primary">Создать</button>
    </form>
@endsection
