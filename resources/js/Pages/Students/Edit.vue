<template>

    <Head :title="`Edit ${student.name} profile`" />

    <MainLayout>
        <TheBackButton :href="route('students.index')" title="Back" />

        <div class="max-w-md">
            <form @submit.prevent="update" class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                    <TheTextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                        :error="form.errors.name" />
                     <TheInputError :message="form.errors.name" class="mt-2" />
                </div>

                <div>
                    <label for="sex" class="block text-sm font-medium text-gray-700">Sex</label>

                    <TheSelectInput v-model="form.sex" id="sex" :error="form.errors.sex" class="mt-1 block w-full">
                        <option v-for="s in studentSex" :key="s.value" :value="Object.keys(s).toString()">
                            {{ Object.values(s).toString() }}
                        </option>
                    </TheSelectInput>
                    <TheInputError :message="form.errors.sex" class="mt-2" />
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700"> Email </label>
                     <TheTextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email"
                        :error="form.errors.email" />
                     <TheInputError :message="form.errors.email" class="mt-2" />
                </div>

                <div>
                    <label for="placeOfBirth" class="block text-sm font-medium text-gray-700"> Place of Birth </label>
                     <TheTextInput id="placeOfBirth" type="text" class="mt-1 block w-full" v-model="form.placeOfBirth"
                        :error="form.errors.placeOfBirth" />
                     <TheInputError :message="form.errors.placeOfBirth" class="mt-2" />
                </div>

                <div>
                    <label for="dateOfBirth" class="block text-sm font-medium text-gray-700"> Date of Birth </label>
                    <Datepicker name="dateOfBirth" v-model="form.dateOfBirth" :format="format" autoApply showNowButton
                        :enableTimePicker="false"></Datepicker>
                     <TheInputError :message="form.errors.dateOfBirth" class="mt-2" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700"> Enrolled in study groups </label>
                    <template v-for="(studyGroup, index) in studyGroups" :key="studyGroup.id">
                        <div class="relative flex items-start">
                            <div class="flex items-center h-5">
                                <TheCheckbox
                                    v-model:checked="form.selectedStudyGroup"
                                    :value="studyGroup.id"
                                    :id="studyGroup.name"
                                    :name="studyGroup.name"
                                />
                            </div>
                            <div class="ml-3 text-sm">
                                <label :for="studyGroup.name" class="font-medium text-gray-700">
                                    {{ studyGroup.name }}
                                </label>
                            </div>
                        </div>
                    </template>
                    <TheInputError :message="form.errors.selectedStudyGroup" class="mt-2" />
                </div>

                <div class="flex justify-between gap-20">
                    <button @click="destroy" :disabled="form.processing" type="button"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Delete
                    </button>

                    <button type="submit" :disabled="form.processing"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save    
                    </button>
                </div>
            </form>
        </div>
    </MainLayout>
</template>

<script>
import MainLayout from '@/Layouts/Main.vue'
import TheBackButton from '@/Components/TheBackButton.vue'
import { Head } from '@inertiajs/inertia-vue3'
import Datepicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'
import TheTextInput from '@/Components/TheTextInput.vue'
import TheSelectInput from '@/Components/TheSelectInput.vue'
import TheInputError from '@/Components/TheInputError.vue'
import TheCheckbox from '@/Components/TheCheckbox.vue'

export default {
    components: {
        MainLayout,
        Head,
        TheBackButton,
        Datepicker,
        TheTextInput,
        TheSelectInput,
        TheInputError,
        TheCheckbox,
    },

    props: {
        studyGroups: {
            type: Object,
            required: true,
        },
        studentSex: {
            type: Array,
            required: true,
        },
        student: {
            type: Object,
            required: true
        }
    },

    remember: 'form',

    data() {
        return {
            form: this.$inertia.form({
                _method: 'put',
                name: this.student.name,
                sex: this.student.sex,
                email: this.student.email,
                placeOfBirth: this.student.placeOfBirth,
                dateOfBirth: this.student.dateOfBirth,
                selectedStudyGroup: this.student.inStudyGroupsIds,
            }),
        }
    },

    setup(props) {
        const date = new Date(props.student.dateOfBirth)

        const format = (date) => {
            const days = ('0' + date.getDate()).slice(-2)
            const months = ('0' + (date.getMonth() + 1)).slice(-2)
            const years = date.getFullYear()

            return `${years}.${months}.${days}.`
        }

        return {
            format,
        }
    },

    methods: {
        update() {
            this.form.post(route('students.update', { id: this.student.id }))
        },

        destroy() {
            if (confirm('Are you sure you want to delete this student? It will be permanently delete all data.')) {
                this.$inertia.delete(route('students.destroy', { id: this.student.id }))
            }
        },
    },
}
</script>