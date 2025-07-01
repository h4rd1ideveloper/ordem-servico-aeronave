@if (is_null($hours))
    <span>N/A</span>
@elseif($hours == 0)
    <span>NEW</span>
@else
    <span>{{ $hours }}</span>
@endif
