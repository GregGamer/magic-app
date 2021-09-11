<?php

namespace App\Http\Middleware;

use App\Models\Catalog;
use App\Models\Edition;
use App\Models\Setting;
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
        if(Setting::week_old()){
            Catalog::updateTable();
            Edition::updateTable();
            //Symbology::updateTable();
        }

        return $next($request);
    }
}
