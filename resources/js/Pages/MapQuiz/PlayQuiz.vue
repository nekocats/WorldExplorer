<script setup>
import {Head, Link, useForm, router} from '@inertiajs/vue3'
import { computed, reactive, ref, watch } from 'vue';
import haversine from 'haversine-distance'

const props = defineProps({
    quiz: {
        type: Object,
        default: () => ({}),
    },
    questions: {
        type: Object,
        default: () => ({}),
    },
    distance: {
        type: Object,
        default: () => ({}),
    },
    currentQuestion: {
        type: Object,
        default: () => ({}),
    },
    location: {
        type: Object,
        default: () => ({}),
    },
    score: {
        type: Object,
        default: () => ({}),
    },

})
console.log(props.quiz)
console.log(props.questions)
console.log(props.location)

watch(
  () => props.location,
  () => {
    console.log(props.location)
  }
)
watch(
  () => props.distance,
  () => {
    console.log(props.distance)
  }
)
watch(
  () => props.score,
  () => {
    console.log(props.score)
  }
)
watch(
  () => props.currentQuestion,
  () => {
    console.log(props.currentQuestion)
  }
)

console.log(props.quiz)
const questions = reactive([])
props.questions.forEach(element => {
questions.push(element)
});
const qCount = questions.length
const currentQ = ref({current: 0})
console.log(currentQ.value.current)
// const a = ref({lat: questions[currentQ.value.current].lat, lng: questions[currentQ.value.current].lng})
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
const currentId = ref(0)
const form = useForm({
  lat: null,
  lng: null,
  id: questions[currentQ.value.current].id,

})
function gMark(event) {
    form.lat = event.latLng.lat()
    form.lng = event.latLng.lng()

  }

const answered = ref(0)
  function submit() {
    answered.value = 1
  router.post('/quizmap/show/' + props.questions[0].map_quiz_id, form, {
    preserveState: true,
  })

}
function nextQ() {
    currentQ.value.current++
    answered.value = 0
}
console.log(props.distance)
</script>



<template class="whitespace-nowrap overflow-hidden w-24 scrollbar-none">
    <Head title="Map Quiz"/>
  <div class='relative  whitespace-nowrap overflow-hidden overscroll-none scrollbar-none bg-frontPageBg bg-cover grid  min-h-screen bg-dots-darker bg-materialgreenlight bg-center dark:bg-materialgreenbg selection:bg-lime-950 selection:text-white'>


      <div class="flex justify-between items-center pl-6 text-lime-700">
          <Link data-te-toggle="tooltip" title="Back to quiz chooser" :href="route('choosequiz')" class="scrollbar-none flex text-2xl p-4 justify-items-right items-right py-4 hover:shadow-lime-700 hover:border-lime-700 rounded-lg hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000 text-shadow shadow-black font-raleway text-lime-700 dark:text-white text-right rounded-lg">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
              </svg>
          </Link> <br>

        <h1 class="dark:text-shadow shadow-black font-raleway box-border text-5xl dark:text-white">{{ questions[currentQ.current].question }}</h1>
        <h1 class="dark:text-shadow shadow-black font-raleway box-border text-5xl text-lime-700  rounded-lg font-bold pr-10">Score: {{ score }}</h1>
        <Link class="hover:shadow-lime-700 hover:border-lime-700 rounded-lg text-shadow shadow-black  text-5xl text-lime-700 hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000" data-te-toggle="tooltip" title="Leaderboard" :href="route('ranking')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7 self-center cursor-pointer">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 01-.982-3.172M9.497 14.25a7.454 7.454 0 00.981-3.172M5.25 4.236c-.982.143-1.954.317-2.916.52A6.003 6.003 0 007.73 9.728M5.25 4.236V4.5c0 2.108.966 3.99 2.48 5.228M5.25 4.236V2.721C7.456 2.41 9.71 2.25 12 2.25c2.291 0 4.545.16 6.75.47v1.516M7.73 9.728a6.726 6.726 0 002.748 1.35m8.272-6.842V4.5c0 2.108-.966 3.99-2.48 5.228m2.48-5.492a46.32 46.32 0 012.916.52 6.003 6.003 0 01-5.395 4.972m0 0a6.726 6.726 0 01-2.749 1.35m0 0a6.772 6.772 0 01-3.044 0" />
          </svg>

        </Link> <br>
    </div>
    <GuestLayout class="scrollbar-none">
    <GMapMap id="vue-map" ref="myMapRef" :center="center" :zoom="10" map-type-id="hybrid" style="width: 100vw; height: 45rem" @click="gMark">
        <GMapMarker   :position="{lat:location.lat, lng:location.lng}">
          </GMapMarker>
       <GMapMarker :position="{lat:form.lat, lng:form.lng}">
        <div class=" absolute top-72 bg-gray-700 opacity-40 hover:opacity-70">
            <button v-if="answered == 1" @click="nextQ" class="w-64 h-36 text-3xl text-white">NEXT</button>
            <form @submit.prevent="submit"><button type="submit" v-if="answered == 0" :disabled="form.processing" class="w-64 h-36 text-3xl text-white">ANSWER</button></form>
        </div>


          </GMapMarker>

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
