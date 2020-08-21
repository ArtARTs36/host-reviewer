<?php

namespace App\Http\Requests;

use App\Concerns\FormRequest;
use App\Models\Command;

class StoreCommand extends FormRequest
{
    public function rules(): array
    {
        return [
            Command::FIELD_DESCRIPTION => 'required|string',
            Command::FIELD_SHELL => 'required|string',
        ];
    }
}
