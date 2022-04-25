<template>

    <Head title="Students" />

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
                        <UserIcon class="h-4 w-4 mr-1 text-black-900" />
                        {{ students.meta.total }} students
                    </div>
                    <Link :href="route('students.create')">
                    <button class="flex items-center ml-6 bg-cyan-400 text-white text-sm rounded-sm">
                        <PencilAltIcon
                            class="bg-cyan-500 h-8 w-8 p-1 px-1.5 rounded-bl-sm rounded-tl-sm text-black-900" />
                        <span class="p-1 px-6">New</span>
                    </button>
                    </Link>
                </div>

                <div>
                    <Paginator :links="students.links" :meta="students.meta" />
                </div>
            </div>
        </div>

        <hr class="mt-8 -ml-10 -mr-10">

        <div class="grid grid-cols-12 gap-20 mt-8">
            <div class="col-span-3">
                <label for="filter" class="uppercase text-gray-500 text-xs">
                    Filters for study groups
                </label>

                <template v-for="(studyGroup, index) in studyGroups">
                    <div class="py-1 relative flex items-start">
                        <div class="flex items-center h-5">
                            <TheCheckbox />
                        </div>
                        <div class="ml-3 text-sm">
                            <label :for="studyGroup.name" class="font-medium text-gray-700">
                                {{ studyGroup.name }}
                            </label>
                        </div>
                    </div>
                </template>
            </div>

            <div class="col-span-9">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th scope="col" class="whitespace-nowrap py-4 pr-3">
                                <TheCheckbox />
                            </th>
                            <th scope="col"
                                class="uppercase py-3.5 pr-10 text-center text-sm font-semibold text-gray-400">
                                Name</th>
                            <th scope="col" class="uppercase pr-8 py-3.5 text-left text-sm font-semibold text-gray-400">
                                Sex
                            </th>
                            <th scope="col" class="uppercase px-3 py-3.5 text-left text-sm font-semibold text-gray-400">
                                Place and date of birth
                            </th>
                            <th scope="col"
                                class="uppercase px-3 py-3.5 text-sm font-semibold text-gray-400 text-right">
                                Groups
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <tr v-if="students.meta.total >= 1" v-for="student in students.data" :key="student.id">
                            <td class="py-4 pr-3 text-sm">
                                <TheCheckbox />
                            </td>
                            <td class="whitespace-nowrap py-4 pr-10 pl-2 text-sm font-medium">
                                <Link :href="route('students.edit', { id: student.id })"
                                    class="hover:underline flex items-center">
                                <img class="w-8 h-8 rounded-full mr-8" :src="`${student.avatar}`"
                                    :alt="`${student.name}'s avatar`">
                                {{ student.name }}
                                </Link>
                            </td>
                            <td class="pr-8 py-4 text-sm">
                                {{ student.sex }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm">
                                {{ student.birthData }}
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-right">
                                {{ studyGroupList(student.inStudyGroups) }}
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
import { SearchIcon, UserIcon, PencilAltIcon } from '@heroicons/vue/outline'
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
        UserIcon,
        PencilAltIcon,
        TheCheckbox
    },

    props: {
        studyGroups: {
            type: Object,
            required: true,
        },
        students: {
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
            filteredStudyGroup: new Array,
            form: {
                search: this.filters.search,
            },
        };
    },

    methods: {
        studyGroupList(inStudyGroups) {
            const array = new Array

            inStudyGroups.map(list => {
                array.push(list.name)
            })

            if (array.length < 1) {
                return 'Not enrolled in any study groups yet.'
            }

            if (array.length > 2) {
                const slicedArray = array.slice(0, 2)
                const remainedStudyGroup = array.filter(x => !slicedArray.includes(x));

                return slicedArray.join(', ') + ' and ' + remainedStudyGroup.length + ' more'
            }

            return array.join(', ')
        },
    },

    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get(this.route('students.index'), pickBy(this.form), { preserveState: true, preserveScroll: true })
            }, 150),
        },
    },
}
</script>