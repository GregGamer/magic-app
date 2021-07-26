<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Lavary\Menu\Menu;

class GenerateMenus
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
        \Menu::make('MyMenu', function($menu){
            $menu->add('Dashboard', [
                'route' => 'dashboard'
            ]);

            $menu->add('Collection Archives', [
                'route' => 'archives.index'
            ]);

            $menu->add('My Decks', [
                'route' => 'decks.index'
            ]);

            $menu->add('Search Cards', [
                'route' => 'cards.index'
            ]);
        });
        return $next($request);
    }
}
