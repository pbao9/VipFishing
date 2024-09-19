<?php
$rating = \App\Models\Ratings::find($id);
$user = $rating->booking->user
?>
<x-link :href="route('admin.user.edit', $user['id'])" :title="$user['fullname']" />
