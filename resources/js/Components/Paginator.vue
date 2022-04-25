<template>
    <nav v-if="links && meta" class="flex items-center justify-between" role="navigation">
        <span class="relative inline-flex">
            <div v-for="(link, index) in meta.links">
                <Link v-if="!isFirstOrLastOrDots(index, meta.links.length, link.label)"
                        :class="[link.active === true ? 'text-orange-500' : 'text-white']" :href="link.url"
                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm leading-5 bg-gray-300 font-bold border-x border-white hover:text-gray-500 focus:outline-none active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                        v-html="link.label">
                </Link>
                <span v-else-if="link.label === '...'" aria-disabled="true"
                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm text-white cursor-default leading-5 bg-gray-300 font-bold border-l border-r border-white hover:text-gray-500 focus:outline-none active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {{ link.label }}
                </span>
            </div>
        </span>
    </nav>
</template>

<script>
import {Link} from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    },

    props: {
        links: Object,
        meta: Object,
    },

    methods: {
        isFirstOrLastOrDots(index, links_length, label) {
            return index === 0 || index === links_length - 1 || label.includes('...');
        },
    },

    computed: {
        onFirstPage() {
            return this.meta.current_page === 1;
        },

        hasMorePages() {
            return this.meta.current_page < this.meta.last_page;
        },

        nextPageUrl() {
            return this.links.next;
        },

        previousPageUrl() {
            return this.links.prev;
        },

        firstItem() {
            return this.meta.from ??= 0;
        },

        lastItem() {
            return this.meta.to ??= 0;
        },

        total() {
            return this.meta.total;
        },
    },
};
</script>