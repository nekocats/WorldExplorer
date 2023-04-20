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

        <div class="flex text-white text-7xl">
            Question
        </div>
        <div class="flex justify-center p-2 items-center ">
        <div class="backdrop-blur-md 	  rounded-full">
            <Link :href="route('welcome')" class="bg-pink-400 bg-opacity-25 text-shadow shadow-black font-raleway text-5xl text-pink-400 py-2 px-60 rounded-full font-bold ">Placeholder answer</Link> <br>
        </div>
        <div class="p-2 rounded-full">
            <Link :href="route('welcome')" class="bg-pink-400 bg-opacity-25 text-shadow shadow-black font-raleway text-5xl text-pink-400 py-2 px-60 rounded-full font-bold ">Placeholder answer</Link> <br>
        </div>
        
       </div>
       <div class="flex justify-center p-2 items-center ">
        <div class="backdrop-blur-md 	  rounded-full">
            <Link :href="route('welcome')" class="bg-pink-400 bg-opacity-25 text-shadow shadow-black font-raleway text-5xl text-pink-400 py-2 px-60 rounded-full font-bold ">Placeholder answer</Link> <br>
        </div>
        <div class="p-2 rounded-full">
            <Link :href="route('welcome')" class="bg-pink-400 bg-opacity-25 text-shadow shadow-black font-raleway text-5xl text-pink-400 py-2 px-60 rounded-full font-bold ">Placeholder answer</Link> <br>
        </div>
        </div>
    </div>
    
</template>
