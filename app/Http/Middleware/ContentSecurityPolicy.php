<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    public function handle($request, Closure $next)
    {
        $nonce = Str::random(40);

        $response = $next($request);

        $response->header('Content-Security-Policy', "script-src 'self' 'nonce-{$nonce}' https://m.stripe.network 'sha256-5DA+a07wxWmEka9IdoWjSPVHb17Cp5284/lJzfbl8KA=' 'sha256-/5Guo2nzv5n/w6ukZpOBZOtTJBJPSkJ6mhHpnBgm3Ls='");

        $request->attributes->set('csp_nonce', $nonce);

        return $response;
    }
}