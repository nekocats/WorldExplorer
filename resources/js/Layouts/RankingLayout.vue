<script setup>
import { ref } from 'vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';

defineProps({
    title: String,
});
console.log(usePage().props);
const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-materialgreenlight dark:bg-materialgreenbg">
            <nav class="bg-materialgreenlight dark:bg-materialgreenbg dark:border-materialgreenbg">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 pt-2 sm:flex">
                                <Link data-te-toggle="tooltip" title="Back to quiz chooser" :href="route('choosequiz')" class="scrollbar-none flex text-3xl text-lime-700 dark:text-lime-500 p-4 py-4 font-raleway rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                                    </svg>
                                </Link> <br>
                                <h2 class=" text-3xl font-bold pt-3.5 text-lime-700 dark:text-lime-500 leading-tight">
                                    Leaderboard
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <header v-if="$slots.header" class="bg-white dark:bg-materialgreenbg shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
