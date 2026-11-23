<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class PreventDoubleSubmit
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->isMethod('POST')) {
            return $next($request);
        }

        $token = $request->input('form_token');

      
        if (! $token || ! Cache::add('used_form_token:' . $token, true, now()->addDay())) {
            return redirect()->back();
        }

        return $next($request);
    }
}