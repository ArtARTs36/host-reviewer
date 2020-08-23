@extends('main')

@section('page_name', 'БД:: Базы')

@section('bar_actions')
    <div class="btn-group mr-2">
        <a href="/databases/create">
            <button type="button" class="btn btn-sm btn-outline-secondary">Создать</button>
        </a>
    </div>
@endsection

@section('content')

    @include('databases.items')

@endsection
