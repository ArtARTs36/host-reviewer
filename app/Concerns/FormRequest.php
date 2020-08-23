<?php

namespace App\Concerns;

use Laravel\Lumen\Http\Request;

/**
 * Class FormRequest
 * @package App\Concerns
 */
abstract class FormRequest extends Request
{
    /**
     * @return array
     */
    abstract public function rules(): array;

    /**
     * @param array|string $keys
     * @return array
     */
    public function onlyValues($keys): array
    {
        return array_values($this->only(...func_get_args()));
    }
}
