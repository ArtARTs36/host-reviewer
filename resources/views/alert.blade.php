@extends('main')

@section('page_name', 'Результат')

@section('bar_actions')
    <div class="btn-group mr-2">
        <a href="javascript:window.history.back();">
            <button type="button" class="btn btn-sm btn-outline-secondary">Назад</button>
        </a>
    </div>
@endsection

@section('content')

    <div class="alert alert-{{ $type }}" role="alert">
        {{ $text }}
    </div>

@endsection
