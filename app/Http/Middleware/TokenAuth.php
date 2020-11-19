<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TokenAuth {
    /**
     * Test how to authenticate with a token using a middleware
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle( Request $request, Closure $next ) {
        $token = $request->header( 'X-API-TOKEN' );
        if ( 'test-value' !== $token ) {
            abort( 401, 'Auth Token not found' );
        }

        return $next( $request );
    }
}
