<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\View\View;

class BackendConnectionError extends Exception
{
    public function render(): View
    {
        return View('errors.error', ['error' => 'Backend error', 'message' => $this->getMessage(), 'code' => '405']);
    }
}
