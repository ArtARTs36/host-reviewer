<?php

namespace App\Concerns;

/**
 * Interface AccessStrategy
 * @package App\Concerns
 */
interface AccessStrategy
{
    /**
     * @param array $fields
     * @return void
     */
    public function setFields(array $fields): void;

    /**
     * @return array
     */
    public function requiredFields(): array;

    /**
     * @return bool
     */
    public function isAccess(): bool;
}
