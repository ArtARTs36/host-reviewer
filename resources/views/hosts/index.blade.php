@extends('main')

@section('page_name', 'Хосты')

@section('bar_actions')
    <div class="btn-group mr-2">
        <a href="/hosts/create">
            <button type="button" class="btn btn-sm btn-outline-secondary">Создать</button>
        </a>
    </div>
@endsection

@section('content')

    @include('hosts.items')

@endsection
