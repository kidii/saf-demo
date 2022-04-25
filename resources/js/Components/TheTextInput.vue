<template>
    <div class="mt-1 relative">
        <input :id="id" :type="type" :value="modelValue" class="block w-full border rounded-md shadow-sm sm:text-sm transition focus:outline-none" :class="[hasError ? errorClass : defaultClass]" @input="$emit('update:modelValue', $event.target.value)" ref="input" />
        <div v-show="hasError" class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
            <ExclamationCircleIcon class="h-5 w-5 text-red-500" aria-hidden="true" />
        </div>
    </div>
</template>

<script>
    import { ExclamationCircleIcon } from '@heroicons/vue/solid'

    export default {
        components: {
            ExclamationCircleIcon,
        },

        props: {
            id: String,
            type: {
                type: String,
                default: 'submit',
            },
            modelValue: String,
            error: String,
        },

        emits: ['update:modelValue'],

        data() {
            return {
                defaultClass: 'border-gray-300 py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500',
                errorClass: 'pr-10 border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500',
            };
        },

        methods: {
            focus() {
                this.$refs.input.focus()
            },
        },

        computed: {
            hasError() {
                return this.error ? true : false
            },
        },
    }
</script>