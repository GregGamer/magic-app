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
                'url' => '/dashboard',
                'route' => 'dashboard'
            ]);

            $menu->add('Collection Archives', [
                'url' => route('archives.index'),
                'route' => 'archives.index'
            ]);

            $menu->add('My Decks', [
                'url' => route('decks.index'),
                'route' => 'decks.index'
            ]);

            $menu->add('Search Cards', [
                'url' => route('cards.index'),
                'route' => 'cards.index'
            ]);
        });
        return $next($request);
    }
}
