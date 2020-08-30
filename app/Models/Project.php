<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $remote_git
 * @property boolean $is_need_create_db
 * @property int $db_connection_id
 * @property DbConnection $dbConnection
 */
class Project extends Model
{
    public const FIELD_NAME = 'name';
    public const FIELD_REMOTE_GIT = 'remote_git';
    public const FIELD_IS_NEED_CREATE_DB = 'is_need_create_db';
    public const FIELD_DB_CONNECTION_ID = 'db_connection_id';

    public const RELATION_HOSTS = 'hosts';

    protected $fillable = [
        self::FIELD_NAME,
        self::FIELD_REMOTE_GIT,
        self::FIELD_IS_NEED_CREATE_DB,
        self::FIELD_DB_CONNECTION_ID,
    ];

    protected $casts = [
        self::FIELD_IS_NEED_CREATE_DB => 'boolean',
    ];

    /**
     * @return HasMany
     */
    public function hosts(): HasMany
    {
        return $this->hasMany(Host::class);
    }

    /**
     * @return BelongsTo
     */
    public function dbConnection(): BelongsTo
    {
        return $this->belongsTo(DbConnection::class);
    }
}
