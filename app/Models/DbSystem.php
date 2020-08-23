<?php

namespace App\Models;

use ArtARTs36\DbCreator\Contracts\System;
use ArtARTs36\DbCreator\SystemFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $key
 */
class DbSystem extends Model
{
    public const FIELD_NAME = 'name';
    public const FIELD_KEY = 'key';

    protected $fillable = [
        self::FIELD_NAME,
        self::FIELD_KEY,
    ];

    /**
     * @return System
     */
    public function toEntity(): System
    {
        return SystemFactory::instance($this->key);
    }
}
