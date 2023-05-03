<script template> 
import { Head, Link } from '@inertiajs/vue3';

</script>
<template>
    <Head title="Finish" />
<div class="relative  bg-frontPageBg bg-cover grid justify-items-center items-center min-h-screen bg-dots-darker bg-center bg-materialgreenbg selection:bg-lime-950 selection:text-white">
    <div>
    <h1 class="scrollbar-none text-shadow shadow-black font-raleway text-6xl text-white py-2 px-20 rounded-lg font-bold">Finished!</h1>
    <h1 class="scrollbar-none text-shadow shadow-black font-raleway text-6xl text-lime-700 py-2 px-20 rounded-lg font-bold">Score: {{ score }}</h1>
    </div>
   <a href="/"><button class=" backdrop-blur-3xl bg-opacity-25 text-shadow shadow-black font-raleway text-5xl text-white py-2 px-20 rounded-lg font-bold">home</button></a>
   
</div>

</template>
