<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h6 class="h6">База данных:</h6>
</div>

<div class="form-check">
    <input type="checkbox" name="install" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Создавать БД</label>
</div>

<br/>

<div class="form-group">
    <label for="exampleFormControlSelect1">Выберите подключение</label>
    <select name="system_id" class="form-control" id="exampleFormControlSelect1">
        @foreach($dbConnections as $connection)
            <option value="{{ $connection->id }}">{{ $connection->getName() }}</option>
        @endforeach
    </select>
</div>

<br/>
