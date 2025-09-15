<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\KitchenSinkService;

class Logout extends Controller
{
    public function __invoke(KitchenSinkService $sinkService)
    {
        $sinkService->logout();

        return redirect()->route('home');
    }
}
