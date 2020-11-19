<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasicAuth {
    /**
     * Middleware for authentication
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle( Request $request, Closure $next ) {
        return Auth::onceBasic() ?: $next( $request );
    }
}
