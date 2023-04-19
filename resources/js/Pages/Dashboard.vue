<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="About">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                About HistoryGuesser
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-black overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome />
                    
                </div>
            </div>
        </div>

        <div href="gameselect" class="block text-indigo-400 group-hover:text-slate-800 transition duration-200" target="_blank">PLAY
            <div class="max-w-7xl mx-auto">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg blur opacity-25 group-hover:opacity-100 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative px-7 py-6 bg-black ring-1 ring-gray-900/5 rounded-lg leading-none flex items-top justify-start space-x-6">
                    <svg class="w-8 h-8 text-purple-600" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.75 6.75C6.75 5.64543 7.64543 4.75 8.75 4.75H15.25C16.3546 4.75 17.25 5.64543 17.25 6.75V19.25L12 14.75L6.75 19.25V6.75Z"></path>
                </svg>
                <div class="space-y-2">
                    <a href="gameselect" class="block text-indigo-400 group-hover:text-slate-800 transition duration-200" target="_blank">PLAY</a>
                </div>
                </div>
            </div>
            </div>
        </div>
    </AppLayout>
</template>
