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
    center.lat = props.location.lat
    center.lng = props.location.lng
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
 const center = reactive({ lat: 58.2449205980223, lng: 22.496933575606914 })
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





    <GuestLayout class="scrollbar-none">
    <GMapMap id="vue-map" ref="myMapRef" :center="center" :zoom="10" map-type-id="hybrid" class="h-screen w-screen"  @click="gMark">
        <GMapMarker   :position="{lat:location.lat, lng:location.lng}">
          </GMapMarker>
       <GMapMarker :position="{lat:form.lat, lng:form.lng}">
           <div class="absolute top-0 inset-x-96 flex justify-between filter backdrop-blur-md bg-gray-300/30 p-5 items-center align-center  rounded-b-3xl">
               <h1 class=" font-raleway box-border text-4xl dark:text-white">{{ questions[currentQ.current].question }}</h1>
               <h1 class=" font-raleway box-border text-4xl text-lime-200  rounded-lg font-bold pl-24">Score: {{ score }}</h1>
           </div>


           <div class=" absolute top-4 left-72 flex backdrop-blur-sm bg-white/30 rounded-3xl ">
               <Link data-te-toggle="tooltip" title="Back to quiz chooser" :href="route('choosequiz')" class="scrollbar-none flex text-2xl p-4 justify-items-right items-right py-4 hover:shadow-lime-700 hover:border-lime-700 rounded-lg hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000 text-shadow shadow-black font-raleway text-lime-700 dark:text-white text-right rounded-lg">
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                   </svg>
               </Link> <br>
              </div>

        <div class=" absolute flex bottom-5 justify-center inset-x-[50rem]  backdrop-blur-3xl bg-white/30  hover:bg-lime-500/30 rounded-3xl">
            <button v-if="answered == 1" @click="nextQ" class="w-32 h-16 text-2xl text-white">NEXT</button>
            <form @submit.prevent="submit"><button type="submit" v-if="answered == 0" :disabled="form.processing" class="w-32 h-16  text-2xl text-white">ANSWER</button></form>
        </div>


          </GMapMarker>

    </GMapMap>
</GuestLayout>

  </template>
