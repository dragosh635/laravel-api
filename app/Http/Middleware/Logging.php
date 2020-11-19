<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class Logging {
    /**
     * Logs the methods used in the api
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle( Request $request, Closure $next ) {
        Log::debug( $request->method() );

        return $next( $request );
    }

    /**
     * Logs the response status
     *
     * @param Request $request
     * @param Response $response
     */
    public function terminate( $request, $response ) {
        Log::debug( $response->status() );
    }
}
