<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property DbConnection $dbConnection
 */
class Database extends Model
{
    public const FIELD_NAME = 'name';
    public const FIELD_DB_CONNECTION_ID = 'db_connection_id';

    public const RELATION_DB_CONNECTION = 'dbConnection';

    protected $fillable = [
        self::FIELD_NAME,
        self::FIELD_DB_CONNECTION_ID,
    ];

    /**
     * @return BelongsTo
     */
    public function dbConnection(): BelongsTo
    {
        return $this->belongsTo(DbConnection::class);
    }
}
