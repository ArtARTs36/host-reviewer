<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $scope
 * @property Collection|EnvKey[] $keys
 * @property string $key
 * @property string $value
 */
class EnvAlias extends Model
{
    public const FIELD_TITLE = 'title';
    public const FIELD_SLUG = 'slug';
    public const FIELD_SCOPE = 'scope';

    public const RELATION_KEYS = 'keys';

    public const SCOPE_DB = 'db';

    public const SLUG_DB_SYSTEM = 'db_system';
    public const SLUG_DB_HOST = 'db_host';
    public const SLUG_DB_PORT = 'db_port';
    public const SLUG_DB_NAME = 'db_name';
    public const SLUG_DB_USER = 'db_user';
    public const SLUG_DB_PASSWORD = 'db_password';

    protected $fillable = [
        self::FIELD_TITLE,
        self::FIELD_SLUG,
        self::FIELD_SCOPE,
    ];

    /**
     * @return HasMany
     */
    public function keys(): HasMany
    {
        return $this->hasMany(EnvKey::class, EnvKey::FIELD_ALIAS_ID);
    }

    public function getKeyAttribute(): string
    {
        return $this->keys->first()->key;
    }
}
