<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $key
 * @property EnvAlias $alias
 * @property Project $project
 */
class EnvKey extends Model
{
    public const FIELD_KEY = 'key';
    public const FIELD_ALIAS_ID = 'alias_id';
    public const FIELD_PROJECT_ID = 'project_id';

    protected $fillable = [
        self::FIELD_KEY,
        self::FIELD_ALIAS_ID,
        self::FIELD_PROJECT_ID,
    ];

    public function alias(): BelongsTo
    {
        return $this->belongsTo(EnvAlias::class, static::FIELD_ALIAS_ID);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
