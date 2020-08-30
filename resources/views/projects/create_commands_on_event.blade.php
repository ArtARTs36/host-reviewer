<div class="accordion" id="accordion-{{ $event }}-host-command">
    @foreach($hostTypes as $type)
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button"
                            data-toggle="collapse"
                            data-target="#host-type-{{ $event }}-{{ $type->id }}"
                            aria-expanded="true"
                            aria-controls="host-type-{{ $event }}-{{ $type->id }}"
                    >
                        <h6 class="h6">{{ $type->name }}</h6>
                    </button>
                </h2>
            </div>

            <div id="host-type-{{ $event }}-{{ $type->id }}" class="collapse hide" aria-labelledby="headingOne"
                 data-parent="#accordion-{{ $event }}-host-command"
            >
                <div class="card-body">
                    <div class="commands-list">
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-success" onclick="addCommand('{{ $event }}', '{{ $type->id }}')">Добавить</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<br/>
