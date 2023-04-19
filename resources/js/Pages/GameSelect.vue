<script setup>
    import { Head, Link } from '@inertiajs/vue3';

    defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>
<template>
<Head title="Welcome" />
    <div class=" relative  bg-cover grid justify-items-center items-center min-h-screen bg-dots-darker bg-center bg-black selection:bg-red-500 selection:text-white">
        <div v-if="canLogin" class="w-full rounded-b-[32px] sm:fixed  sm:top-0 sm:right-0 p-6 text-right">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-shadow shadow-black text-[#7E4400] font-raleway text-pink-400 dark:text-pink-400 text-[40px]">Dashboard</Link>
        </div>
    <div class="flex justify-center items-center min-h-screen whitespace-nowrap">
        <div class="backdrop-blur-md 	py-4 px-0.5 rounded-full">
            <Link :href="route('quiz')" class="bg-pink-400 backdrop-blur-3xl bg-opacity-25 text-shadow shadow-black font-raleway text-7xl text-pink-400 py-2 px-60 rounded-full font-bold ">Quiz</Link> <br>
        </div>
        <div class="backdrop-blur-md	py-4 px-0.5 rounded-full">
            <Link :href="route('map')" class="bg-pink-400 backdrop-blur-3xl	bg-opacity-25 text-shadow shadow-black font-raleway text-7xl text-pink-400 py-2 px-60 rounded-full font-bold ">Map Quiz</Link> <br>
        </div>
       </div>
    </div>
</template>
