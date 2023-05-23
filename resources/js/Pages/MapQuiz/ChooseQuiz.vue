<script setup>

import {Head, Link} from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const props = defineProps({
    quizzes: {
        type: Object,
        default: () => ({}),
    },
})
console.log(Ziggy.routes)
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
              <Link class="pl-3 pt-1 hover:border-lime-700 rounded-lg text-shadow shadow-black  text-5xl text-lime-700 hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000" data-te-toggle="tooltip" title="Leaderboard" :href="route('quizmap.ranking', quiz.id )">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9 self-center cursor-pointer">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
                </svg>

              </Link> <br>
            </div>

        <div class="p-5 justify-center self-center grid">


            <Link class="hover:shadow-lime-700 hover:border-lime-700 rounded-lg text-shadow shadow-black  text-5xl text-lime-700 hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000" data-te-toggle="tooltip" title="Back to gamemode selection" :href="route('welcome')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                </svg>
            </Link> <br>


        </div>
  </div>
</template>
