<script setup>

import {Head, Link} from '@inertiajs/vue3';

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
    <div class="relative  bg-frontPageBg bg-cover grid justify-items-center items-center min-h-screen bg-dots-darker bg-center bg-materialgreenbg selection:bg-lime-950 selection:text-white">
    <div class="flex flex-col items-center justify-center ">
        <span class=" text-white text-4xl">
            Choose a
        </span>
        <h1 class="text-6xl font-bold text-lime-600">Quiz</h1>
    </div>
            <div class="flex py-4 px-0.5 border-4 border-lime-950 shadow-4xl shadow-lime-950 hover:shadow-lime-700 hover:border-lime-700 rounded-lg hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000" :key="quiz.id" v-for="quiz in quizzes">
            <Link class="backdrop-blur-4xl bg-opacity-25 text-shadow shadow-black font-raleway text-4xl text-white py-2 px-20 rounded-lg font-bold" :href="route('quizmap.show', quiz.id)" >{{ quiz.title }}</Link>
        </div>
        <div class="p-5 justify-center self-center hover:shadow-lime-700 hover:border-lime-700 rounded-lg text-shadow shadow-black  text-5xl text-lime-300 hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000">
            <Link :href="route('gameselect')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
            </Link> <br>
        </div>
  </div>
</template>
