<?php

namespace App\Http\Middleware;

use App\Models\Catalog;
use App\Models\Edition;
use Closure;
use Illuminate\Http\Request;

class UpdateDatabase
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
        Edition::updateTable();



        return $next($request);
    }
}
