<template>
    <input v-model="proxyChecked" :value="value" type="checkbox"
        class="h-4 w-4 text-orange-500 shadow-inner outline-none bg-gray-200 focus:ring-0 border-none" />
</template>

<script>
export default {
    props: {
        checked: {
            type: [Array, Boolean],
            default: false,
        },
        value: {
            default: null,
        },
    },
    computed: {
        proxyChecked: {
            get() {
                return this.checked
            },
            set(val) {
                this.$emit("update:checked", val)
            },
        },
    },
}
</script>