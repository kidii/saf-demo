<template>
    <div :class="[isActive ? 'text-cyan-500' : 'text-gray-400']" class="uppercase font-semibold">
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