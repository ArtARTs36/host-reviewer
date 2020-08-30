<?php

namespace App\Http\Requests;

use App\Concerns\FormRequest;
use App\Models\Project;

class StoreProject extends FormRequest
{
    public const FIELD_UPDATE_COMMANDS = 'update_commands';
    public const FIELD_INSTALL_COMMANDS = 'install_commands';
    public const FIELD_DB_CREATE = 'db_create';
    public const FIELD_ENV_KEYS = 'env_keys';

    public function rules(): array
    {
        return [
            Project::FIELD_NAME => 'required|string',
            Project::FIELD_REMOTE_GIT => 'required|string',
            static::FIELD_UPDATE_COMMANDS => 'sometimes|array',
            static::FIELD_INSTALL_COMMANDS => 'sometimes|array',
            static::FIELD_DB_CREATE => 'sometimes',
            static::FIELD_ENV_KEYS => 'sometimes',
            static::FIELD_ENV_KEYS . '.*.key' => 'required|string',
            static::FIELD_ENV_KEYS . '.*.alias_id' => 'required|int',
        ];
    }

    public function hasEnvKeys(): bool
    {
        return $this->has(static::FIELD_ENV_KEYS);
    }

    public function getEnvKeys(): array
    {
        if (!$this->hasEnvKeys()) {
            return [];
        }

        return $this->get(static::FIELD_ENV_KEYS);
    }

    public function forProject(): array
    {
        return $this->only(Project::FIELD_NAME, Project::FIELD_REMOTE_GIT);
    }
}
