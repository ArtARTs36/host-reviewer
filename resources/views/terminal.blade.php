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

    <style>
        #terminal {
            background: #000;
            padding: 15px
        }

        #terminal p {
            color: #ccc;
        }

        #terminal p:hover {
            color: #fff;
        }
    </style>

    <div id="terminal">
         @foreach(explode("\n", $text) as $line)

             <p>
                 {{ $line }}
             </p>

         @endforeach
    </div>

@endsection
