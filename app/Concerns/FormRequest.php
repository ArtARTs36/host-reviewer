<?php

namespace App\Concerns;

use Laravel\Lumen\Http\Request;

/**
 * Class FormRequest
 * @package App\Concerns
 */
abstract class FormRequest extends Request
{
    /**
     * @return array
     */
    abstract public function rules(): array;
}
