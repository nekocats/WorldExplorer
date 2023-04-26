<script setup>
import {Head, Link, useForm} from '@inertiajs/vue3'
import { reactive, ref } from 'vue';
import haversine from 'haversine-distance'

const props = defineProps({
    quiz: {
        type: Object,
        default: () => ({}),
    },
})

const score = ref(0)
console.log(props.quiz)
const questions = reactive([])
props.quiz[0].questions.forEach(element => {
questions.push(element)
});
const qCount = questions.length
const currentQ = ref({current: 0})
console.log(currentQ.value.current)
const a = ref({lat: questions[currentQ.value.current].lat, lng: questions[currentQ.value.current].lng})
console.log(questions)
const guess = ref({lat: null, lng: null})

let gameOver = false

function mark(event) {
guess.value.lat = event.latLng.lat()
guess.value.lng = event.latLng.lng()
console.log(guess.value)
console.log(a.value)
const answer = ref(haversine(a.value, guess.value))
console.log(answer.value)
if (gameOver == false) {



    if (gameOver == false && answer.value <= 50000) {
        score.value = score.value + 5000
    } else if(gameOver == false && answer.value > 50000 && answer.value < 100000) {
        score.value = score.value + 10000 - Math.round(answer.value / 10)
    }
    if (qCount == currentQ.value.current + 1) {
        gameOver = true
    }
    if (qCount != currentQ.value.current + 1 && gameOver == false) {
        currentQ.value.current++

    }

    a.value.lat = questions[currentQ.value.current].lat
    a.value.lng = questions[currentQ.value.current].lng
    console.log(currentQ.value.current)

}

  }


</script>



<template class="whitespace-nowrap overflow-hidden w-24 scrollbar-none">
    <Head title="Map Quiz"/>
  <div class='relative  whitespace-nowrap overflow-hidden overscroll-none scrollbar-none bg-frontPageBg bg-cover grid  min-h-screen bg-dots-darker bg-materialgreenlight bg-center dark:bg-materialgreenbg selection:bg-lime-950 selection:text-white'>


      <div class="flex justify-between items-center pl-6 text-lime-700">
          <Link :href="route('choosequiz')" class="scrollbar-none flex text-2xl p-4 justify-items-right items-right py-4 hover:shadow-lime-700 hover:border-lime-700 rounded-lg hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000 text-shadow shadow-black font-raleway text-lime-700 dark:text-white text-right rounded-lg">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
              </svg>
          </Link> <br>
        <h1 class="dark:text-shadow shadow-black font-raleway box-border text-5xl dark:text-white">{{ questions[currentQ.current].question }}</h1>
        <h1 class="dark:text-shadow shadow-black font-raleway box-border text-5xl text-lime-700  rounded-lg font-bold pr-10">Score: {{ score }}</h1>

    </div>
    <GuestLayout class="scrollbar-none">
    <GMapMap id="vue-map" ref="myMapRef" :center="center" :zoom="10" map-type-id="hybrid" style="width: 100vw; height: 45rem" @click="mark">
       <GMapMarker :position="{lat:guess.lat, lng:guess.lng}" :clickable="true"
          @click="openMarker(marker.id)" >

          <div>

        </div>

          </GMapMarker>
           <!-- <GMapMarker  :position="{lat:questions[currentQ.current].lat, lng:questions[currentQ.current].lng}">
          </GMapMarker> -->
    </GMapMap>
</GuestLayout>
</div>
  </template>

  <script>
    export default {
    data() {
      return {
        openedMarkerID: null,
        center: { lat: 58.2449205980223, lng: 22.496933575606914 },

      };
    },
    methods: {
      openMarker(id) {
         this.openedMarkerID = id
      },

    }
  };
  </script>
