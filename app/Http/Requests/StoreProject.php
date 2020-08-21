<?php

namespace App\Http\Requests;

use App\Concerns\FormRequest;
use App\Models\Project;

class StoreProject extends FormRequest
{
    public function rules(): array
    {
        return [
            Project::FIELD_NAME => 'required|string',
            Project::FIELD_REMOTE_GIT => 'required|string',
        ];
    }
}
