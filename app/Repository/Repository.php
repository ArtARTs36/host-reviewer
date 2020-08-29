<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class Repository
 * @package App\Repository
 */
abstract class Repository
{
    /** @var string */
    private $modelClass;

    /**
     * Repository constructor.
     * @param string|null $modelClass
     */
    public function __construct(string $modelClass = null)
    {
        $this->modelClass = $modelClass ?? $this->getModelClass();
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return '\\App\\Models\\' .
            str_replace('Repository', '', class_basename(static::class));
    }

    /**
     * @return Builder
     */
    protected function newQuery(): Builder
    {
        return $this->modelClass::query();
    }
}
