<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function warning(string $text)
    {
        return $this->alert('warning', $text);
    }

    public function danger(string $text)
    {
        return $this->alert('danger', $text);
    }

    public function success(string $text)
    {
        return $this->alert('success', $text);
    }

    public function alert(string $type, string $text)
    {
        return view('alert', [
            'type' => $type,
            'text' => $text,
        ]);
    }
}
