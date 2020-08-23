<?php

namespace App\Http\Requests;

use App\Concerns\FormRequest;
use App\Models\DbConnection;

/**
 * Class StoreDbConnection
 * @package App\Http\Requests
 */
class StoreDbConnection extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            DbConnection::FIELD_SYSTEM_ID => 'required|integer',
            DbConnection::FIELD_HOST => 'required|string',
            DbConnection::FIELD_PORT => 'required|integer',
            DbConnection::FIELD_LOGIN => 'required|string',
            DbConnection::FIELD_PASSWORD => 'required|string',
        ];
    }
}
