<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Widgets\Widget;

class Kalender extends Widget
{
    protected static string $view = 'filament.widgets.kalender';
    protected int | string | array $columnSpan = 1;
    public $currentMonth;
    public $currentYear;
    public $daysOfWeek;
    public $calendar;
    public function getColumns(): int | string | array
    {
        return 2;
    }
    public function mount()
    {
        $this->currentMonth = now()->format('F');
        $this->currentYear = now()->year;
        $this->daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        $this->generateCalendar();
    }

    public function generateCalendar()
    {
        $firstDayOfMonth = Carbon::createFromFormat('F Y', "{$this->currentMonth} {$this->currentYear}")->startOfMonth();
        $lastDayOfMonth = Carbon::createFromFormat('F Y', "{$this->currentMonth} {$this->currentYear}")->endOfMonth();
        $daysInMonth = $lastDayOfMonth->day;

        $this->calendar = [];
        $week = [];

        // Fill in the days of the previous month
        for ($i = 0; $i < $firstDayOfMonth->dayOfWeek; $i++) {
            $week[] = ['day' => '', 'isCurrentMonth' => false, 'date' => null]; // Add 'date' with null
        }

        // Fill in the days of the current month
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $week[] = [
                'day' => $day,
                'date' => $this->currentYear . '-' . $firstDayOfMonth->month . '-' . $day, // This key should be defined now
                'isCurrentMonth' => true,
            ];
            if (count($week) == 7) {
                $this->calendar[] = $week;
                $week = [];
            }
        }

        // Fill in the days of the next month
        while (count($week) < 7) {
            $week[] = ['day' => '', 'isCurrentMonth' => false, 'date' => null]; // Add 'date' with null
        }
        if (!empty($week)) {
            $this->calendar[] = $week;
        }
    }

    public function prevMonth()
    {
        $this->currentMonth = Carbon::parse($this->currentMonth)->subMonth()->format('F');
        $this->generateCalendar();
    }

    public function nextMonth()
    {
        $this->currentMonth = Carbon::parse($this->currentMonth)->addMonth()->format('F');
        $this->generateCalendar();
    }

    public function selectDate($date)
    {

    }
}
