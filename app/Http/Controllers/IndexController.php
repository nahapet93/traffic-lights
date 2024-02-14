<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Routing\Controller;

class IndexController extends Controller
{
    /**
     * Взять все логи из таблицы и передать в представление
     */
    function index()
    {
        $logs = Log::with('message')->orderBy('id', 'desc')->get();
        return view('index', compact('logs'));
    }
}
