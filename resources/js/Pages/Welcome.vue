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
            <Link v-if="$page.props.auth.user" :href="route('mapquizzes')" class="font-semibold dark:text-shadow shadow-black text-[#7E4400] font-raleway text-lime-600 dark:text-lime-600 text-2xl">Management</Link>
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="p-4 font-semibold dark:text-shadow shadow-black text-[#7E4400] font-raleway text-lime-600 dark:text-lime-600 text-2xl">About</Link>
            <template v-else>
                <Link :href="route('login')" class="font-semibold text-lime-400 text-[40px]  dark:text-gray-200">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 font-semibold  text-[40px] text-lime-600  dark:text-lime-600 ">Register</Link>

                
            </template>
        </div>
        <div >
            <span class="center text-lime-900 dark:text-white text-3xl">
                Welcome to 
            </span>
            <h1 class="center text-lime-600 text-5xl">
                WorldExplorer
            </h1>
        </div>
    
        <div class="py-4 px-0.5 border-4 border-lime-950 shadow-2xl shadow-lime-950 hover:shadow-lime-700 hover:border-lime-700 rounded-lg hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000">
            <Link :href="route('gameselect')" class=" backdrop-blur-3xl bg-opacity-25 dark:text-shadow shadow-black font-raleway text-5xl text-lime-900 dark:text-white py-2 px-20 rounded-lg font-bold ">Play</Link> <br>
        </div>
    </div>
</template>
