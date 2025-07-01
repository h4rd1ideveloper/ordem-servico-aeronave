@if (is_null($date) && is_null($unit_measurement))
    <span>N/A</span>
@else
    <span>{{ $date }}{{ $unit_measurement }}</span>
@endif
