<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/AppLayout.vue';

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
        <div v-if="canLogin" class="w-full rounded-b-[32px] sm:fixed  sm:top-0 sm:right-0 p-6 text-right">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-shadow shadow-black text-[#7E4400] font-raleway text-lime-600 dark:text-lime-600 text-2xl">About</Link>

            <template v-else>
                <Link :href="route('login')" class="font-semibold text-gray-200 text-[40px]  dark:text-gray-200">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 font-semibold  text-[40px] text-lime-600  dark:text-lime-600 ">Register</Link>


            </template>
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
        <div class="p-5 justify-center self-center hover:shadow-lime-700 hover:border-lime-700 rounded-lg text-shadow shadow-black  text-5xl text-lime-700 dark:text-lime-300 hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000">
            <Link :href="route('welcome')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 self-center">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            </Link> <br>
        </div>
    </div>
</template>
