<script setup>
    import { Head, Link } from '@inertiajs/vue3';
</script>
<template>
    <div>
        <div class="backdrop-blur-md	py-4 px-0.5 rounded-full">
            <Link :href="route('gameselect')" class="bg-gray-200 backdrop-blur-3xl	bg-opacity-25 text-shadow shadow-black font-estonia text-7xl text-gray-200 py-2 px-60 rounded-full font-bold ">Quiz</Link> <br>
        </div>
        <div class="backdrop-blur-md	py-4 px-0.5 rounded-full">
            <Link :href="route('gameselect')" class="bg-gray-200 backdrop-blur-3xl	bg-opacity-25 text-shadow shadow-black font-estonia text-7xl text-gray-200 py-2 px-60 rounded-full font-bold ">Map Quiz</Link> <br>
        </div>

    </div>
    


</template>
