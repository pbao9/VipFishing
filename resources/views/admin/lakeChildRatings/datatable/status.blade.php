@if ($rating->status == 1)
    <span class="badge bg-primary">Có</span>
@elseif ($rating->status == 0)
    <span class="badge bg-red-lt">Không</span>
@endif
