<x-filament-widgets::widget>
    <x-filament::section>
        <div style="display:flex">
            <div id="kalender" class="calendar w-full" style="margin-left:-20px;max-width: 450px;max-height:200px;font-size:10px;margin-top:-20px;margin-left:2px;">
                <div class="calendar-header">
                    <button wire:click="prevMonth" class="calendar-button">Previous</button>
                    <span style="font-weight: bold;font-size:12px;">{{ $currentMonth }} {{ $currentYear }}</span>
                    <button wire:click="nextMonth" class="calendar-button">Next</button>
                </div>
                <div class="calendar-grid">
                    @foreach ($daysOfWeek as $day)
                    <div class="day-header">{{ $day }}</div>
                    @endforeach
                    @foreach ($calendar as $week)
                    @foreach ($week as $day)
                    @php
                    // Format day date with leading zeros
                    $formattedDay = "";
                    if ($day['date']){
                    $formattedDay = \Carbon\Carbon::createFromFormat('Y-n-j', $day['date'])->format('Y-m-d');
                    }
                    @endphp
                    <div class="day {{ $day['isCurrentMonth'] ? '' : 'not-current-month' }}"
                        wire:click="selectDate('{{ $day['date'] }}')"
                        style="cursor: pointer;{{  now()->format('Y-m-d') == $formattedDay ? 'background-color:#007bff;color:white;' : '' }}">
                        {{ $day['day'] }}
                    </div>
                    @endforeach
                    @endforeach
                </div>
            </div>
            <div id="jam" style="width:100%;padding-left:10px;margin-top:-12px;text-align:center;border:1px solid #007bff;margin-left:10px;border-radius:5px;max-height:100%">
                <h2 class="text-2xl font-semibold text-gray-800">Waktu : </h2>
                <div class="mt-4">
                    <div
                        x-load-js="[@js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('vanilla-calendar-js'))]"
                        x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('vanilla-calendar-css'))]"
                        id="calendar"></div>
                    <p class="text-3xl font-bold text-blue-600 clock" id="live-time">00:44:00 WIB</p>
                </div>
                <h2 class="text-2xl font-semibold text-gray-800">Lokasi : </h2>
                <div class="mt-4">
                    <div
                        x-load-js="[@js(\Filament\Support\Facades\FilamentAsset::getScriptSrc('vanilla-calendar-js'))]"
                        x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('vanilla-calendar-css'))]"
                        id="calendar"></div>
                    <p class="text-3xl font-bold text-blue-700 clock" id="location">...</p>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
