@php
    $lakeChild = \App\Models\Lakechilds::find($lakechild_id);
@endphp

<x-link :href="route('admin.lakes.item.edit', $lakeChild->id)"  :title="$lakeChild->name"/>

{{--{{$lakechild_id}}--}}
