<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LogController extends Controller
{
    /**
     * Сохранить лог в таблице
     */
    function store(Request $request)
    {
        return Log::create(['message_id' => $request->state])->message;
    }
}
