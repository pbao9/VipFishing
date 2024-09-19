@if(isset($bank))
    <x-link :href="route('admin.banks.edit', $bank_id)" target="_blank" :title="$bank['name']"/>
@endif
