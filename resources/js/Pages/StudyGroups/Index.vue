<template>

    <Head title="Study Groups" />

    <MainLayout>
        <div class="grid grid-cols-12 gap-20 items-end">
            <div class="col-span-3">
                <div>
                    <label for="search" class="uppercase text-gray-500 text-xs">
                        Search for name
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-1 flex items-center pointer-events-none">
                            <SearchIcon class="h-5 w-5 text-white" aria-hidden="true" />
                        </div>
                        <input v-model="form.search" type="text" name="search" id="search" autocomplete="off"
                            class="block w-full pl-8 sm:text-sm focus:ring-0 border-none shadow-inner bg-gray-200" />
                    </div>
                </div>
            </div>

            <div class="col-span-9 flex justify-between items-end">
                <div class="flex">
                    <div class="uppercase flex items-center text-sm">
                        <UserGroupIcon class="h-4 w-4 mr-1 text-black-900" />
                        {{ studyGroups.meta.total }} study groups
                    </div>
                    <Link :href="route('study-groups.create')">
                    <button class="flex items-center ml-6 bg-cyan-400 text-white text-sm rounded-sm">
                        <PencilAltIcon
                            class="bg-cyan-500 h-8 w-8 p-1 px-1.5 rounded-bl-sm rounded-tl-sm text-black-900" />
                        <span class="p-1 px-6">New</span>
                    </button>
                    </Link>
                </div>

                <div>
                    <Paginator :links="studyGroups.links" :meta="studyGroups.meta" />
                </div>
            </div>
        </div>

        <hr class="mt-8 -ml-10 -mr-10">

        <div class="grid grid-cols-12 gap-20 mt-8">
            <div class="col-span-12">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="uppercase py-3.5 pr-2 text-left text-sm font-semibold text-gray-400">
                                Name
                            </th>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-400">
                                Subject
                            </th>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-400">
                                Leader
                            </th>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-400">
                                Beginning at
                            </th>
                            <th scope="col" class="uppercase py-3.5 text-left text-sm font-semibold text-gray-400">
                                 Number of students
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <tr v-if="studyGroups.meta.total >= 1" v-for="studyGroup in studyGroups.data" :key="studyGroup.id">
                            <td class="whitespace-nowrap py-4 pr-2 pl-2 text-sm font-medium">
                                <Link :href="route('study-groups.edit', { id: studyGroup.id })" class="hover:underline flex items-center">
                                    <span>{{ studyGroup.name }}</span>
                                </Link>
                            </td>
                            <td class="pr-8 py-4 text-sm">
                                {{ studyGroup.subject }}
                            </td>
                            <td class="pr-8 py-4 text-sm">
                                {{ studyGroup.leader }}
                            </td>
                            <td class="pr-8 py-4 text-sm">
                                {{ studyGroup.beginningAtParsed }}
                            </td>
                            <td class="pr-8 py-4 text-sm">
                                {{ studyGroup.studentsCount }} students
                            </td>
                        </tr>
                        <tr v-else>
                            <td class="font-semibold text-lg text-center pt-4" colspan="5">
                                No results.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </MainLayout>
</template>

<script>
import MainLayout from '@/Layouts/Main.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'
import Paginator from '@/Components/Paginator.vue'
import { SearchIcon, UserGroupIcon, PencilAltIcon } from '@heroicons/vue/outline'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import TheCheckbox from '@/Components/TheCheckbox.vue'

export default {
    components: {
        MainLayout,
        Head,
        Link,
        Paginator,
        SearchIcon,
        UserGroupIcon,
        PencilAltIcon,
        TheCheckbox
    },

    props: {
        studyGroups: {
            type: Object,
            required: true,
        },
        filters: {
            type: Object,
            required: false,
        },
    },

    data() {
        return {
            form: {
                search: this.filters.search,
            },
        };
    },

    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get(this.route('study-groups.index'), pickBy(this.form), { preserveState: true, preserveScroll: true })
            }, 150),
        },
    },
}
</script>