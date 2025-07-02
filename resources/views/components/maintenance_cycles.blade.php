@if (is_null($cycles))
    <span >N/A</span>
@elseif($cycles == 0)
    <span >NEW</span>
@else
    <span >{{ $cycles }}</span>
@endif
