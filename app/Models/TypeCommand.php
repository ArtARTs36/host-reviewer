<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property HostType $type
 * @property Command $command
 * @property int $event
 */
class TypeCommand extends Model
{
    public const EVENT_INSTALL = 1;
    public const EVENT_UPDATE = 2;

    public const FIELD_PROJECT_ID = 'project_id';
    public const FIELD_TYPE_ID = 'type_id';
    public const FIELD_COMMAND_ID = 'command_id';
    public const FIELD_EVENT = 'event';

    public const RELATION_COMMAND = 'command';

    protected $table = 'host_type_commands';

    protected $fillable = [
        self::FIELD_PROJECT_ID,
        self::FIELD_TYPE_ID,
        self::FIELD_COMMAND_ID,
        self::FIELD_EVENT,
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function type()
    {
        return $this->belongsTo(HostType::class);
    }

    public function command()
    {
        return $this->belongsTo(Command::class);
    }
}
