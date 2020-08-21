<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $remote_git
 */
class Project extends Model
{
    public const FIELD_NAME = 'name';
    public const FIELD_REMOTE_GIT = 'remote_git';

    public const RELATION_HOSTS = 'hosts';

    protected $fillable = [
        self::FIELD_NAME,
        self::FIELD_REMOTE_GIT,
    ];

    /**
     * @return HasMany
     */
    public function hosts(): HasMany
    {
        return $this->hasMany(Host::class);
    }
}
