@if (isset($rank))
    <x-link :href="route('admin.ranks.edit', $rank_id)" target="_blank" :title="$rank['title']" />
@else
@endif
