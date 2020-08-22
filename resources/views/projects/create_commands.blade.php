<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h6 class="h6">Команды после установки:</h6>
</div>

@include('projects.create_commands_on_event', [
    'event' => 'install',
])

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h6 class="h6">Команды после обновления:</h6>
</div>

@include('projects.create_commands_on_event', [
    'event' => 'update',
])

<script>
    const commands = {!! $commands !!};

    function addCommand(event, typeId)
    {
        $('#host-type-' + event +'-' + typeId + ' .commands-list').append('' +
            '<div class="form-group">' +
            '<select name="' + event + '_commands[' + typeId + '][]>                        <select name="project_id" class="form-control">\n' +
            '                            @foreach($commands as $command)\n' +
            '                                <option value="{{ $command->id }}">\n' +
            '                                    [{{ $command->description }}]\n' +
            '                                    {{ $command->shell }}\n' +
            '                                </option>\n' +
            '                            @endforeach\n' +
            '                        </select>' +
            '</div>');
    }
</script>
