@extends('main')

@section('page_name', 'Переменные окружения '. $host->domain)

@section('content')
        @if(!$host->envExists())
            <div class="alert alert-warning">
                Файл {{ $host->getEnvPath() }} не существует
            </div>
        @else
            @include('hosts.env_form')
        @endif
@endsection
