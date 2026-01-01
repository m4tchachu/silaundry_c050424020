<?php 

namespace App\Http\Responses;

use Filament\Auth\Http\Responses\LoginResponse as ResponsesLoginResponse;
use Filament\Pages\Dashboard;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse extends ResponsesLoginResponse
{
    public function toResponse($request): RedirectResponse | Redirector
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->to(Dashboard::getUrl(panel: 'admin'));
        }
        
        if ($user->hasRole('kasir')) {
            return redirect()->to(Dashboard::getUrl(panel: 'kasir'));
        }

        return redirect()->to(Dashboard::getUrl(panel: 'user'));
    }
}