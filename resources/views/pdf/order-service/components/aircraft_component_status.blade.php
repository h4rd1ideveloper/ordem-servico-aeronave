@if (isset($status) && !is_null($status))
    {{ $status }}
@elseif(is_null($value))
    N/A
@else
    {{ $value }}
@endif
