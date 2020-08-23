<?php

namespace App\Models;

use ArtARTs36\DbCreator\Access;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property DbSystem $system
 * @property string $host
 * @property string $port
 * @property string $login
 * @property string $password
 */
class DbConnection extends Model
{
    public const FIELD_SYSTEM_ID = 'system_id';
    public const FIELD_HOST = 'host';
    public const FIELD_PORT = 'port';
    public const FIELD_LOGIN = 'login';
    public const FIELD_PASSWORD = 'password';

    public const RELATION_SYSTEM = 'system';

    protected $fillable = [
        self::FIELD_SYSTEM_ID,
        self::FIELD_HOST,
        self::FIELD_PORT,
        self::FIELD_LOGIN,
        self::FIELD_PASSWORD,
    ];

    /**
     * @return BelongsTo
     */
    public function system(): BelongsTo
    {
        return $this->belongsTo(DbSystem::class);
    }

    /**
     * @return Access
     */
    public function toAccess(): Access
    {
        return Access::make($this->login, $this->password, $this->port, $this->host);
    }
}
