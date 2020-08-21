<?php

namespace App\Concerns;

trait Entityable
{
    public function toEntity(): Entity
    {
        $class = static::CLASS_ENTITY;

        return new $class($this->getAttributes());
    }
}
