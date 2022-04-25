<template>
    <Link :class="[isActive ? 'bg-white' : 'bg-gray-100']"
        class="p-10 rounded-t-md border-l border-t border-r border-gray-300 w-2/6"
    >
        <slot />
    </Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    components: {
        Link
    },

    props: {
        isActive: {
            type: Boolean,
            required: false,
            default: false,
        }
    },
}
</script>