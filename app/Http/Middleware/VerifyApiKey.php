<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = optional(Setting::find(1))->api_key;

        if (! $request->filled('api_key')) {
            return response()->json(['status' => 'failed', 'message' => 'Forbidden, API Key is Required!'], 404);
        }

        if ($request->api_key !== $apiKey) {
            return response()->json(['status' => 'failed', 'message' => 'Oops, API Key is Incorrect!'], 404);
        }

        return $next($request);
    }
}
