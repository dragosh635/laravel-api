<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HttpHeaders {
    /**
     * Middleware for adding a custom header inside the request
     *
     * @param Request $request
     * @param Closure $next
     * @param string $text
     *
     * @return mixed
     */
    public function handle( Request $request, Closure $next, string $text = '' ) {
        $response = $next( $request );
        $response->header( 'X-JOBS', $text );

        return $response;
    }
}
