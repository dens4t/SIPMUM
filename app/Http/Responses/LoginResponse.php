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
        // Redirect to admin panel if user is admin
        if (auth()->user() && auth()->user()->is_admin) {
            return redirect()->to('admin');
        }

        // Redirect to pegawai panel for regular users
        return redirect()->to('pegawai');
    }
}
