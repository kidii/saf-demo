<template>
    <div class="flex items-center gap-2">
        <TheNavCardBody :href="route('students.index')" :isActive="route().current('students.*')">
            <TheNavCardHeader :isActive="route().current('students.*')">
                Students
            </TheNavCardHeader>

            <TheNavCardFooter :isActive="route().current('students.*')">
                {{ $page.props.stats.allStudentsCount }} student registered
            </TheNavCardFooter>
        </TheNavCardBody>

        <TheNavCardBody :href="route('study-groups.index')" :isActive="route().current('study-groups.*')">
            <TheNavCardHeader :isActive="route().current('study-groups.*')">
                Study Groups
            </TheNavCardHeader>

            <TheNavCardFooter :isActive="route().current('study-groups.*')">
                {{ $page.props.stats.allStudyGroupsCount }} study groups with {{ $page.props.stats.allStudentsInStudyGroups }} students
            </TheNavCardFooter>
        </TheNavCardBody>
    </div>
</template>

<script setup>
import TheNavCardBody from '@/Components/TheNavCardBody.vue'
import TheNavCardHeader from '@/Components/TheNavCardHeader.vue'
import TheNavCardFooter from '@/Components/TheNavCardFooter.vue'
</script>