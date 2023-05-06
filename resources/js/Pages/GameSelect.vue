<script setup>
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

    defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>
<template>
<Head title="Gamemode select"/>
    <div class="relative  bg-cover grid justify-items-center items-center min-h-screen bg-dots-darker bg-center bg-materialgreenlight dark:bg-materialgreenbg selection:bg-lime-950 selection:text-white">
        <ApplicationLogo class="block h-40 justify-center self-center items-center w-auto" />
        <div v-if="canLogin" class="w-full rounded-b-[32px] sm:fixed  sm:top-0 sm:right-0 p-6 text-right">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-shadow shadow-black text-[#7E4400] font-raleway text-lime-600 dark:text-lime-600 text-2xl">About</Link>
        </div>
        <div >
            <h1 class="text-4xl font-bold tracking-tight text-lime-600 sm:text-6xl">Select Gamemode</h1>
        </div>
        <div class="grid justify-items-center gap-6">
        <div>
            <Link :href="route('quiz')" class="rounded-md bg-lime-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-lime-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Quiz (Work in progress)</Link> <br>
        </div>
        <div>
            <Link :href="route('choosequiz')" class="rounded-md bg-lime-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-lime-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Map Quiz</Link> <br>
        </div>
    </div>
        <div class="p-5 justify-center self-center">
            <span>
                <Link class="hover:shadow-lime-700 hover:border-lime-700 rounded-lg text-shadow shadow-black  text-5xl text-lime-700 hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000" data-te-toggle="tooltip" title="Leaderboard" :href="route('ranking')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 self-center cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 01-1.161.886l-.143.048a1.107 1.107 0 00-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 01-1.652.928l-.679-.906a1.125 1.125 0 00-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 00-8.862 12.872M12.75 3.031a9 9 0 016.69 14.036m0 0l-.177-.529A2.25 2.25 0 0017.128 15H16.5l-.324-.324a1.453 1.453 0 00-2.328.377l-.036.073a1.586 1.586 0 01-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 01-5.276 3.67m0 0a9 9 0 01-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
                </svg>
            </Link> <br>
                <Link class="hover:shadow-lime-700 hover:border-lime-700 rounded-lg text-shadow shadow-black  text-5xl text-lime-700 hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000" data-te-toggle="tooltip" title="Go back to the homepage" :href="route('welcome')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 self-center cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            </Link> <br>
            </span>
        </div>
    </div>
</template>
