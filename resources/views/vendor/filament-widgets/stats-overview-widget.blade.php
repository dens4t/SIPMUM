@php
    $columns = $this->getColumns();
@endphp

<x-filament-widgets::widget class="fi-wi-stats-overview">
    <x-filament::grid
        :default="1"
        :md="$columns"
        :lg="$columns"
        :xl="$columns"
        class="gap-6"
    >
        @foreach ($this->getCachedStats() as $stat)
            {{ $stat }}
        @endforeach
    </x-filament::grid>
</x-filament-widgets::widget>
