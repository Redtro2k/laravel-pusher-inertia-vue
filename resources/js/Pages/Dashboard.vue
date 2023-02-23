<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Message from './Message.vue';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">You're logged in!</div>
                    <!-- for message components -->
                    <message :loadMessage="$page.props.messages" />
                    <!-- for notification -->
                    <div class="bg-blue-300 p-3 m-2" v-for="notification in $page.props.notifications" :key="notification.id">
                        <span class="font-semibold">{{ notification.data.name }}</span> starting to follow you!
                        <a class="bg-red-400 text-white text-sm p-2" v-if="notification.read_at == null" :href="route('markasread', notification.id)">Mark as read</a>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
