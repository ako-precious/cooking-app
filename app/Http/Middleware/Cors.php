<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { $response = $next($request);

        // Check if the response is an instance of Symfony\Component\HttpFoundation\Response
        if ($response instanceof \Symfony\Component\HttpFoundation\Response) {
            // Add CORS headers to the response
            $response->headers->set('Access-Control-Allow-Origin', '*');
            $response->headers->set('Access-Control-Allow-Methods', '*');
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
            $response->headers->set('Access-Control-Allow-Headers', '*');
            $response->headers->set('Accept', 'application/json');
        }

        // Return the modified response
        return $response;
    
    }
}
