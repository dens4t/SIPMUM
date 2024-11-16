<?php
namespace App\Http\Responses;

use App\Filament\Resources\OrderResource;
use App\Providers\Filament\AdminPanelProvider;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        // Here, you can define which resource and which page you want to redirect to
        if (auth()->user()->is_admin) return redirect()->to('admin');
        return redirect()->to('pegawai');
    }
}
