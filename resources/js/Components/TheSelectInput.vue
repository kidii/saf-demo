<template>
    <div :class="$attrs.class">
        <select :id="id" ref="input" v-model="selected" v-bind="{ ...$attrs, class: null }" class="mt-1 block w-full pl-3 py-2 pr-10 sm:text-sm border rounded-md shadow-sm focus:outline-none transition" :class="[hasError ? errorClass : defaultClass]" >
            <slot />
        </select>
    </div>
</template>

<script>
    export default {
        inheritAttrs: false,
        
        props: {
            id: {
                type: String,
                default(test, ing) {
                    return `select-input-${Math.random() * 1000}`;
                },
            },
            modelValue: [String, Number, Boolean, Array],
            label: String,
            error: String,
        },

        data() {
            return {
                selected: this.modelValue,
                defaultClass: 'border-gray-300 focus:ring-indigo-500 focus:border-indigo-500',
                errorClass: 'border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500',
            };
        },

        watch: {
            selected(selected) {
                this.$emit("update:modelValue", selected);
            },
        },

        methods: {
            focus() {
                this.$refs.input.focus();
            },
            select() {
                this.$refs.input.select();
            },
        },

        computed: {
            hasError() {
                return this.error ? true : false;
            },
        },
    };
</script>