<?php

namespace App\Http\Requests;

use App\Concerns\FormRequest;
use App\Models\HostType;

/**
 * Class StoreHostType
 * @package App\Http\Requests
 */
class StoreHostType extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            HostType::FIELD_NAME => 'required|string',
        ];
    }
}
