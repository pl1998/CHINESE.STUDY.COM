<?php

namespace App\Http\Traits;

use Inertia\Inertia;
use App\Models\ConfigSite;
trait InertiaTrait
{
    public function inertia(string $view, array $data = []): \Inertia\Response
    {
        return Inertia::render($view, $data);
    }

    public function inertiaConfig(string $view, array $data = []): \Inertia\Response
    {
        $config = ConfigSite::getConfig();
   
        return Inertia::render($view, array_merge($data, ['config' => $config]));
    }
}
