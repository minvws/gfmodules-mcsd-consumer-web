<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use App\Exceptions\BackendConnectionError;

class IndexController extends Controller
{
    private string $mcsdUrl;

    public function __construct()
    {
        $this->mcsdUrl = Config::get('app.mcsd_fastapi_app_url');
    }

    public function __invoke(): View
    {
        return view('index', ['suppliers' => $this->getSupplierNames()]);
    }

    /**
     * @return array<string>
     */
    private function getSupplierNames(): array
    {
        try {
            $mapper = Http::connectTimeout(1)->timeout(1)->get($this->mcsdUrl . '/supplier');
            if ($mapper->status() !== 200) {
                throw new BackendConnectionError('Error occurred: ' . $mapper->status() . ' ' . $mapper->body());
            }
            return $mapper->json();
        } catch (\Exception $e) {
            throw new BackendConnectionError($e->getMessage());
        }
    }
}
