<?php

namespace App\Concerns;

/**
 * Interface Entity
 * @package App\Concerns
 */
interface Entity
{
    /**
     * Entity constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes);
}
