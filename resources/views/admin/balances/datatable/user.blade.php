@if(isset($user))
    @php
        $title = "{$user['fullname']} ({$user['phone']})";
    @endphp
    <x-link :href="route('admin.user.edit', $user_id)" target="_blank" :title="$title" />
@endif
