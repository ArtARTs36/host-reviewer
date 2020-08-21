@extends('main')

@section('page_name', 'Создать хост')

@section('content')
    <form action="/hosts" method="POST">
        <div class="form-group">
            <label for="host-form-create__domain">Домен</label>
            <input type="text" class="form-control" name="domain" id="host-form-create__domain">
        </div>

        <div class="form-group">
            <label for="host-form-create__remote_git">Путь в ФС</label>
            <input type="text" value="{{ $pathToHosts }}" class="form-control" name="path" id="host-form-create__path">
        </div>

        <div class="form-group">
            <label for="host-form-create__remote_git">Git: Ветка</label>
            <input type="text" value="dev" class="form-control" name="git_branch" id="host-form-create__path">
        </div>

        <div class="form-group">
            <label for="exampleFormControlSelect1">Выберите проект</label>
            <select name="project_id" class="form-control" id="exampleFormControlSelect1">
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-check">
            <input type="checkbox" name="install" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Установить репозиторий</label>
        </div>

        <br/>

        <button type="submit" class="btn btn-primary">Создать</button>
    </form>

    <script>
        window.onload = function() {
            $('#host-form-create__domain').on('input', function (event) {
                $('#host-form-create__path').val('{{ $pathToHosts }}/' + event.target.value);
            });
        };
    </script>
@endsection
