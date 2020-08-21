<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 */
class HostType extends Model
{
    public const FIELD_NAME = 'name';

    public const RELATION_HOSTS = 'hosts';

    protected $fillable = [
        self::FIELD_NAME,
    ];

    public function hosts(): HasMany
    {
        return $this->hasMany(Host::class, 'type_id');
    }
}
