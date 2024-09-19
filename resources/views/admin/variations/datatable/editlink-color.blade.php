
<div class="d-flex gap-3 align-items-center">
    <div class="avatar" style="background-color: {{ $meta_value['color'] ?? '#FFFFFF' }}" data-demo-color></div>
    <x-link :href="route('admin.attribute.variation.edit', $id)" :title="$name"/>
</div>