<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use ArtARTs36\HostReviewerCore\Entities\Command as Entity;

/**
 * Class Command
 * @package App\Models
 * @property int $id
 * @property string $description
 * @property string $shell
 */
class Command extends Model
{
    public const FIELD_DESCRIPTION = 'description';
    public const FIELD_SHELL = 'shell';

    protected $fillable = [
        self::FIELD_DESCRIPTION,
        self::FIELD_SHELL,
    ];

    /**
     * @return Entity
     */
    public function toEntity(): Entity
    {
        return new Entity($this->shell);
    }
}
