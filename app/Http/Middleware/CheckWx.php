<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\wxController;


class CheckWx
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        wxController::checkWxInfo();

        return $next($request);
    }
}
