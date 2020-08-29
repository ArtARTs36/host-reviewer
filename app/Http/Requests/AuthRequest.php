<?php

namespace App\Http\Requests;

use App\Concerns\FormRequest;
use App\User;

/**
 * Class AuthRequest
 * @package App\Http\Requests
 */
class AuthRequest extends FormRequest
{
    public const FIELD_LOGIN = User::FIELD_LOGIN;
    public const FIELD_PASSWORD = User::FIELD_PASSWORD;

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            static::FIELD_LOGIN => 'required|string',
            static::FIELD_PASSWORD => 'required|string',
        ];
    }
}
