<?php

namespace App\Http\Requests;

use App\Concerns\FormRequest;

/**
 * @property string $shell
 */
class ExecuteRawCommand extends FormRequest
{
    public const FIELD_SHELL = 'shell';

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            static::FIELD_SHELL => 'string',
        ];
    }
}
