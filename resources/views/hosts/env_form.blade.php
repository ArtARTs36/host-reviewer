<form action="/hosts/{{ $host->id }}/env" method="POST">

    @foreach($variables as $key => $value)
        <div class="form-group">
            <label for="host-form-create__variable-{{ $key }}">{{ $key }}</label>
            <input type="text" value="{{ $value }}" class="form-control"
                   name="variables[{{ $key }}]"
                   id="host-form-create__variable-{{ $key }}"
            >
        </div>
    @endforeach
    <br/>

    <button type="submit" class="btn btn-primary">Обновить</button>
</form>
