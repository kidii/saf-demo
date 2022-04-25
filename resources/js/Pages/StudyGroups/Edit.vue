<template>

    <Head :title="`Edit ${studyGroup.name}'s data`" />

    <MainLayout>
        <TheBackButton :href="route('study-groups.index')" title="Back" />

        <div class="max-w-md">
            <form @submit.prevent="update" class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                    <TheTextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                        :error="form.errors.name" />
                    <TheInputError :message="form.errors.name" class="mt-2" />
                </div>

                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700"> Subject </label>
                    <TheTextInput id="subject" type="text" class="mt-1 block w-full" v-model="form.subject"
                        :error="form.errors.subject" />
                    <TheInputError :message="form.errors.subject" class="mt-2" />
                </div>

                <div>
                    <label for="leader" class="block text-sm font-medium text-gray-700"> Leader </label>
                    <TheTextInput id="leader" type="text" class="mt-1 block w-full" v-model="form.leader"
                        :error="form.errors.leader" />
                    <TheInputError :message="form.errors.leader" class="mt-2" />
                </div>

                <div>
                    <label for="beginningAt" class="block text-sm font-medium text-gray-700"> Beginning at </label>
                    <Datepicker name="beginningAt" v-model="form.beginningAt" :format="format" autoApply showNowButton
                        :enableTimePicker="true"></Datepicker>
                    <TheInputError :message="form.errors.beginningAt" class="mt-2" />
                </div>

                <!-- <div>
                    <label class="block text-sm font-medium text-gray-700"> Enroll to study groups </label>
                    <template v-for="(studyGroup, index) in studyGroups">
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
                </div> -->

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

<script >
import MainLayout from '@/Layouts/Main.vue'
import TheBackButton from '@/Components/TheBackButton.vue'
import { Head } from '@inertiajs/inertia-vue3'
import Datepicker from '@vuepic/vue-datepicker'
import '@vuepic/vue-datepicker/dist/main.css'
import TheTextInput from '@/Components/TheTextInput.vue'
import TheInputError from '@/Components/TheInputError.vue'
import TheCheckbox from '@/Components/TheCheckbox.vue'

export default {
    components: {
        MainLayout,
        Head,
        TheBackButton,
        Datepicker,
        TheTextInput,
        TheInputError,
        TheCheckbox
    },

    props: {
        studyGroup: {
            type: Object,
            required: true,
        }
    },

    remember: 'form',

    data() {
        return {
            form: this.$inertia.form({
                _method: 'put',
                name: this.studyGroup.name,
                subject: this.studyGroup.subject,
                leader: this.studyGroup.leader,
                beginningAt: this.studyGroup.beginningAt,
            }),
        }
    },

    setup(props) {
        const date = new Date(props.studyGroup.beginningAt)

        const format = (date) => {
            const days = ('0' + date.getDate()).slice(-2)
            const months = ('0' + (date.getMonth() + 1)).slice(-2)
            const years = date.getFullYear()
            const hours = ('0' + date.getHours()).slice(-2)
            const minutes = ('0' + date.getMinutes()).slice(-2)
            const seconds = ('0' + date.getSeconds()).slice(-2)

            return `${years}.${months}.${days}. ${hours}:${minutes}:${seconds}`
        }

        return {
            format,
        }
    },

    methods: {
        update() {
            this.form.post(route('study-groups.update', { id: this.studyGroup.id }))
        },

        destroy() {
            if (confirm('Are you sure you want to delete this study group? It will be permanently delete all data.')) {
                this.$inertia.delete(route('study-groups.destroy', { id: this.studyGroup.id }))
            }
        },
    },
}
</script>