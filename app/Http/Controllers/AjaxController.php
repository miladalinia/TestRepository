<?php

namespace App\Http\Controllers;

use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MongoDB\Driver\Session;

class AjaxController extends Controller
{
    public function view()
    {
        return view('test');
    }


    public function send_http_request(Request $request)
    {

        Log::info($request->all());

        return response()->json(['success' => 'get your data']);
    }
}
