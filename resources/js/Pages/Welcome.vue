<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script> 


<template class="bg">
    <Head title="Welcome" />
    <div class="relative  bg-materialgreenlight dark:bg-materialgreenbg bg-cover grid justify-items-center items-center min-h-screen bg-center selection:bg-lime-950 selection:text-white">
        <div v-if="canLogin" class="w-full rounded-b-[32px] sm:fixed  sm:top-0 sm:right-0 p-6 text-right">
            <Link v-if="$page.props.auth.user" :href="route('login')" class="font-semibold text-lime-400 text-sm  dark:text-gray-200">Management</Link>
            <template v-else>
                <Link :href="route('login')" class="font-semibold text-lime-400 text-sm  dark:text-gray-200">Log in</Link>
                <Link v-if="canRegister" :href="route('register')" class="ml-4 font-semibold  text-sm text-lime-600  dark:text-lime-600 ">Register</Link>
            </template>
        </div>
        <div class="text-center">
        <h1 class="text-4xl font-bold tracking-tight text-lime-600 sm:text-6xl">WorldExplorer</h1>
        <p class="mt-6 text-lg leading-8 text-white max-w-[65ch]">Welcome to WorldExplorer, the addictive map guessing game! thousands of locations. Plus, create your own maps and challenge yourself or others to guess your custom locations. Start playing now!</p>
        <div class="mt-10 flex items-center justify-center gap-x-6">
          <a :href="route('gameselect')" class="rounded-md bg-lime-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-lime-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Play</a>
          <a :href="route('dashboard')" class="text-sm font-semibold leading-6 text-white">Learn more <span aria-hidden="true">→</span></a>
        </div>
        </div>
    </div>
</template>
