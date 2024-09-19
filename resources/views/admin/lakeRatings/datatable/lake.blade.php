<x-link
    :href="route('admin.lakes.edit', $lake['id'] ?? '')"
    :title="($lake['name'] ?? '') . (isset($lake['name'], $lake['phone'])
 && $lake['name'] && $lake['phone'] ? ' - ' : '') . ($lake['phone'] ?? '')"
/>
