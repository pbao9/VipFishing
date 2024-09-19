@if(isset($admin))
<x-link :href="route('admin.admin.edit', $admin_id)" target="_blank" :title="$admin['fullname']"/>
@else

@endif