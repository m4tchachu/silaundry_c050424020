<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Filament\Pages\Dashboard;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectToProperPanelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {   
        if (auth()->check()) {
            $user = auth()->user();
            $currentPanel = Filament::getCurrentPanel()?->getId();

            if ($user->hasRole('admin') && $currentPanel !== 'admin') {
                return redirect()->to(Dashboard::getUrl(panel: 'admin'));
            }

            if ($user->hasRole('kasir') && $currentPanel !== 'kasir') {
                return redirect()->to(Dashboard::getUrl(panel: 'kasir'));
            }

            if ($user->hasRole('user') && $currentPanel !== 'user') {
                return redirect()->to(Dashboard::getUrl(panel: 'user'));
            }
        }
        return $next($request);
    }
}
