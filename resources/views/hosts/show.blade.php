@extends('main')

@section('page_name', $host->domain)

@section('content')
    <form action="/hosts/{{ $host->id }}/raw-command" method="POST">
        <div class="form-group">
            <label for="host-form-create__domain">Команда</label>
            <input type="text" class="form-control" name="shell" id="host-raw-command__shell">
        </div>

        <br/>

        <button type="submit" class="btn btn-primary">Выполнить</button>
    </form>

    <hr/>

    <form action="/hosts/{{ $host->id }}/raw-command" method="POST">
        <div class="form-group">
            <label for="host-form-create__domain">Команда</label>

            <select name="shell" class="form-control" id="exampleFormControlSelect1">
                @foreach($commands as $command)
                    <option value="{{ $command->shell }}">{{ $command->shell }}</option>
                @endforeach
            </select>
        </div>

        <br/>

        <button type="submit" class="btn btn-primary">Выполнить</button>
    </form>

    <hr/>
@endsection
