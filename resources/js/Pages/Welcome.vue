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
    <div class="relative bg-frontPageBg bg-cover grid justify-items-center items-center min-h-screen bg-dots-darker bg-center bg-gray-300 selection:bg-red-500 selection:text-white">
        <div v-if="canLogin" class="w-full rounded-b-[32px] sm:fixed  sm:top-0 sm:right-0 p-6 text-right">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-shadow shadow-black text-[#7E4400] font-estonia text-gray-200 dark:text-gray-200 text-[40px]">About</Link>
            
            <template v-else>
                <Link :href="route('login')" class="font-semibold text-gray-200 text-[40px]  dark:text-gray-200">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 font-semibold  text-[40px] text-gray-200  dark:text-gray-200 ">Register</Link>

                
            </template>
        </div>
        <div class="backdrop-blur-md	py-4 px-0.5 rounded-full">
            <Link :href="route('gameselect')" class="bg-gray-200 backdrop-blur-3xl bg-opacity-25 text-shadow shadow-black font-estonia text-7xl text-gray-200 py-2 px-60 rounded-full font-bold ">Play</Link> <br>
        </div>
    </div>
</template>
