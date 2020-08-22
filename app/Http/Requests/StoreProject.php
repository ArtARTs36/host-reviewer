<?php

namespace App\Http\Requests;

use App\Concerns\FormRequest;
use App\Models\Project;

class StoreProject extends FormRequest
{
    public const FIELD_UPDATE_COMMANDS = 'update_commands';
    public const FIELD_INSTALL_COMMANDS = 'install_commands';

    public function rules(): array
    {
        return [
            Project::FIELD_NAME => 'required|string',
            Project::FIELD_REMOTE_GIT => 'required|string',
            static::FIELD_UPDATE_COMMANDS => 'sometimes|array',
            static::FIELD_INSTALL_COMMANDS => 'sometimes|array',
        ];
    }
}
