@extends('main')

@section('page_name', 'Типы хостов')

@section('bar_actions')
    <div class="btn-group mr-2">
        <a href="/hosts/types/create">
            <button type="button" class="btn btn-sm btn-outline-secondary">Создать</button>
        </a>
    </div>
@endsection

@section('content')

    @include('hosts.types.items')

@endsection
