<template>
    <div class="max-w-7xl mx-auto pt-12 pb-40">
        <div class="flex justify-between items-center ml-10 mr-10 mb-12">
            <Link href="/">
                <ApplicationLogo class="w-60 h-30" />
            </Link>

            <div class="flex items-center">
                <img class="w-10 h-10 rounded-full mr-2" src="https://ui-avatars.com/api/?name=Adam" alt="Adam's avatar">
                Adam
                <ChevronDownIcon class="h-4 w-4 ml-1 text-black-900" />
            </div>
        </div>

        <div>
            <TheNav />
        </div>

        <div class="bg-white rounded-b-md rounded-tr-md border-l border-b border-r border-gray-300 p-10">
            <TheFlashMessage />
            <slot />
        </div>
    </div>
</template>

<script setup>
    import { Link } from '@inertiajs/inertia-vue3'
    import ApplicationLogo from '@/Components/ApplicationLogo.vue'
    import TheNav from '@/Components/TheNav.vue'
    import TheFlashMessage from '@/Components/TheFlashMessage.vue'
    import { ChevronDownIcon } from '@heroicons/vue/outline'
</script>
