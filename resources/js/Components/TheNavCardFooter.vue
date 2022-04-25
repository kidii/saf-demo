<template>
    <div :class="[isActive ? 'text-gray-500' : 'text-gray-400']" class="mt-2 text-sm font-semibold">
        <slot />
    </div>
</template>

<script>
export default {
    props: {
        isActive: {
            type: Boolean,
            required: false,
            default: false,
        }
    },
}
</script>