<?php

namespace App\Http\Requests;

use App\Concerns\FormRequest;
use App\Models\Database;

/**
 * Class StoreDatabase
 * @package App\Http\Requests
 */
class StoreDatabase extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            Database::FIELD_NAME => 'required|string',
            Database::FIELD_DB_CONNECTION_ID => 'required|integer',
        ];
    }
}
