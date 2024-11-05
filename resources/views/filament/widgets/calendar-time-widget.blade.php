<div class="p-6 bg-white rounded-lg shadow-md text-left" {{-- Changed from text-center to text-left --}}
    x-data="{}"
    x-load-js="[@js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('calendar-time-widget'))]">
    <h2 class="text-2xl font-semibold text-gray-800">Waktu dan Tanggal Sekarang</h2>
    <div class="mt-4">
        {{$this->form}}
        <div
            x-load-js="[@js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('vanilla-calendar-js'))]"
            x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('vanilla-calendar-css'))]"
            id="calendar"></div>
        <p class="text-3xl font-bold text-blue-600 mt-2 clock" id="live-time">{{ $currentTime }}</p>
        <p class="text-2xl font-semibold text-gray-800">{{ $currentDate }}</p>
    </div>
</div>

<div id="calendar" style="max-width: 900px; margin: 0 auto;"></div>
