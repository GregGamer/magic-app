<?php

namespace App\Http\Middleware;

use App\Models\Catalog;
use Closure;
use Illuminate\Http\Request;

class updateDatabase
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        Catalog::updateTable();



        return $next($request);
    }
}
