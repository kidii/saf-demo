<template>
    <div class="flex items-center mb-6 text-gray-600">
        <ArrowLeftIcon class="h-4 w-4 mr-2"/>
        <Link :href="href">{{ title }}</Link>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import { ArrowLeftIcon } from '@heroicons/vue/outline'

export default {
    components: {
        Link,
        ArrowLeftIcon
    },

    props: {
        href: {
            type: String,
            required: true
        },
        title: {
            type: String,
            required: true
        }
    },

    methods: {
        back() {
            window.history.back()
        },
    }
}
</script>