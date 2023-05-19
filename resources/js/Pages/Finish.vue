<script setup>
import { Head, Link} from '@inertiajs/vue3';
import { ref } from 'vue';

    defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,

});

const shareButton = ref(null); 

const shareURL = () => {
  var currentURL = window.location.href;

  navigator.clipboard.writeText(currentURL)
    .then(() => {
      // Show a message or perform additional actions
      alert('URL copied to clipboard!');
    })
    .catch((error) => {
      // Handle error if copying to clipboard fails
      console.error('Failed to copy URL to clipboard:', error);
    });

}
</script>
<template>
    <Head title="Finish" />
<div class="relative  bg-frontPageBg bg-cover grid justify-items-center items-center min-h-screen bg-dots-darker bg-center bg-materialgreenbg selection:bg-lime-950 selection:text-white">
    <div>
    <h1 class="scrollbar-none text-shadow shadow-black font-raleway text-6xl text-white py-2 px-20 rounded-lg font-bold">Finished!</h1>
    <h1 class="scrollbar-none text-shadow shadow-black font-raleway text-6xl text-lime-700 py-2 px-20 rounded-lg font-bold">Score: {{ score }}</h1>
    </div>
    <div class="">
        <span>
            <Link ref="shareButton" class="hover:shadow-lime-700 hover:border-lime-700 rounded-lg text-shadow shadow-black text-5xl text-lime-700 hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000" data-te-toggle="tooltip" title="Go back to the homepage" :href="route('finish')" @click="shareURL">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
        <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z" />
    </svg>
    </Link> <br>

    <Link class="hover:shadow-lime-700 hover:border-lime-700 rounded-lg text-shadow shadow-black  text-5xl text-lime-700 hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000" data-te-toggle="tooltip" title="Go back to the homepage" :href="route('welcome')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12 self-center cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
    </Link> <br>
   
        </span>
    </div>

</div>

</template>
