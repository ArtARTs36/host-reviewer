<?php

namespace App\Http\Requests;

use App\Concerns\FormRequest;
use App\Models\Host;

class StoreHost extends FormRequest
{
    public const FIELD_INSTALL = 'install';

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            Host::FIELD_DOMAIN => 'required|string',
            Host::FIELD_PATH => 'required|string',
            Host::FIELD_PROJECT_ID => 'required|string',
            Host::FIELD_GIT_BRANCH => 'required|string',
            static::FIELD_INSTALL => 'sometimes',
        ];
    }
}
