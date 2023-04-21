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
        <span class=" text-white text-3xl">
            Choose a
        </span>
        <h1 class="text-6xl font-bold text-lime-600">Quiz</h1>
    </div>
            <div class="flex py-4 px-0.5 border-4 border-lime-950 shadow-2xl shadow-lime-950 hover:shadow-lime-700 hover:border-lime-700 rounded-lg hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000" :key="quiz.id" v-for="quiz in quizzes">
            <Link class="backdrop-blur-2xl bg-opacity-25 text-shadow shadow-black font-raleway text-5xl text-white py-2 px-20 rounded-lg font-bold" :href="route('quizmap.show', quiz.id)" >{{ quiz.title }}</Link>
        </div>
        <div class="py-2 px-0.5 border-4 border-lime-950 shadow-2xl shadow-lime-950 hover:shadow-lime-700 hover:border-lime-700 rounded-lg hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000">
            <Link :href="route('gameselect')" class=" backdrop-blur-3xl bg-opacity-25 text-shadow shadow-black font-raleway text-5xl text-white  px-5 rounded-lg font-bold ">&lt;</Link> <br>
        </div>
  </div>
</template>
