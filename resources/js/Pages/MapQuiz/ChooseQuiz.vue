<script setup>

import {Head, Link} from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const props = defineProps({
    quizzes: {
        type: Object,
        default: () => ({}),
    },
})
console.log(props.quizzes)
</script>
<template>
    <Head title="Choose quiz"/>
    <div class="relative  bg-frontPageBg bg-cover grid justify-items-center items-center min-h-screen bg-dots-darker bg-center bg-materialgreenlight dark:bg-materialgreenbg selection:bg-lime-950 selection:text-white">
    <div class="flex flex-col items-center justify-center ">
        <ApplicationLogo class="h-40 w-auto justify-self-center" />
        <h1 class="text-4xl font-bold tracking-tight text-lime-600 sm:text-6xl">Select Gamemode</h1>
    </div>
            <div class="flex " :key="quiz.id" v-for="quiz in quizzes">
            <Link class="rounded-md bg-lime-600 px-20 py-2.5 text-xl font-semibold text-white shadow-sm hover:bg-lime-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" :href="route('quizmap.show', quiz.id)" >{{ quiz.title }}</Link>
        </div>
        <div class="p-5 justify-center self-center hover:shadow-lime-700 hover:border-lime-700 rounded-lg text-shadow shadow-black  text-5xl text-lime-700 hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000">
            <Link :href="route('gameselect')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
            </Link> <br>
        </div>
  </div>
</template>
