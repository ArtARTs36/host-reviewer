<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $ip
 * @property boolean $access
 * @property int $host_id
 */
class Ip extends Model
{
    public const FIELD_HOST_ID = 'host_id';
    public const FIELD_ACCESS = 'access';
    public const FIELD_IP = 'ip';

    protected $fillable = [
        self::FIELD_HOST_ID,
        self::FIELD_ACCESS,
        self::FIELD_IP,
    ];

    public function host(): BelongsTo
    {
        return $this->belongsTo(Ip::class);
    }
}
