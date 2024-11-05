<?php

namespace App\Filament\Widgets;

use App\Models\Bagian;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Unit;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Widgets\Widget;

class CalendarTimeWidget extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.widgets.calendar-time-widget';

    public static bool $fullWidth = true; // Set widget to full width if needed

    public $pegawai = null;

    public function mount(Pegawai $record)
    {
        $this->pegawai = Pegawai::find(auth()->user()->id_pegawai);
        $this->form->fill([]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            // Other fields...
            TextInput::make('date_of_birth_display')
                ->label('Date of Birth')
                ->required()
                ->placeholder('Select your date of birth')
                ->reactive() // Enable reactivity
                ->afterStateUpdated(function ($state) {
                    // You can also update the actual date field if necessary
                    $this->form->getState()['date_of_birth'] = $state;
                }),

            DatePicker::make('date_of_birth')
                ->label('Select Date')
                ->closeOnDateSelection()
                ->displayFormat('d/m/Y')
                ->afterStateUpdated(function ($state) {
                    // Update the display input when date is picked
                    $this->form->getState()['date_of_birth_display'] = $state;
                }),
        ])->statePath('data');
    }

    protected function getViewData(): array
    {
        return [
            'currentDate' => Carbon::now()->isoFormat('dddd, DD MMMM YYYY'),
            'currentTime' => Carbon::now()->format('H:i:s'),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            // Other fields...
            DatePicker::make('date_of_birth')
                ->label('Date of Birth')
                ->required()
                ->placeholder('Select your date of birth')
                ->displayFormat('d/m/Y'), // Adjust the display format as needed
        ];
    }
}
