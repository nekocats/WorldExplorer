<script setup>
import {Head, Link, useForm, router} from '@inertiajs/vue3'
import {  reactive, ref, watch } from 'vue';
import answerIcon from "./Icons/icons8-map-pin-48.png"
import guessIcon from "./Icons/guess.png"
import ConfettiExplosion from "vue-confetti-explosion";

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

watch(
  () => props.location,
  () => {
    center.lat = props.location.lat
    center.lng = props.location.lng

  }
)
watch(
  () => props.distance,
  () => {

  }
)
watch(
  () => props.score,
  () => {

  }
)
watch(
  () => props.currentQuestion,
  () => {

  }
)

const currentQ = ref({current: 0})


const guess = ref({lat: null, lng: null})

function mark(event) {
guess.value.lat = event.latLng.lat()
guess.value.lng = event.latLng.lng()

  }
 const center = reactive({ lat: 58.2449205980223, lng: 22.496933575606914 })
const currentId = ref(0)
const form = useForm({
  lat: null,
  lng: null,
  id: props.questions[currentQ.value.current].id,

})
function gMark(event) {
    if (answered.value == 0) {
        form.lat = event.latLng.lat()
        form.lng = event.latLng.lng()
    }


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
</script>
<template class="whitespace-nowrap overflow-hidden w-24 scrollbar-none">
    <Head title="Map Quiz"/>
    <GuestLayout class="scrollbar-none">
    <GMapMap id="vue-map" ref="myMapRef" :center="center" :zoom="10" map-type-id="hybrid" class="h-screen w-screen"  @click="gMark">

        <GMapMarker :icon="answerIcon" :animation="1"   :position="{lat:location.lat, lng:location.lng}" v-if="answered == 1">
          </GMapMarker>
          <GMapPolyline v-if="answered == 1"
      :path="[{lat:form.lat, lng:form.lng}, {lat:location.lat, lng:location.lng}]"
        ref="polyline" />
       <GMapMarker :icon="guessIcon"  :position="{lat:form.lat, lng:form.lng}">
           <div class="absolute right-24 top-0">
               <img class="rounded-b-3xl w-auto h-40 " :src="questions[currentQ.current].image" alt="">
           </div>
        <div class="absolute top-0 inset-x-96 flex justify-between filter backdrop-blur-md bg-gray-300/30 p-5 items-center align-center rounded-b-3xl">


    <h1 class="font-raleway box-border text-4xl text-white">{{ questions[currentQ.current].question }}</h1>
    <h1 class="font-raleway box-border text-4xl text-white">{{ currentQ.current + 1 }} / {{ questions.length }}</h1>
    <h1 class="font-raleway box-border text-4xl text-lime-200 rounded-lg font-bold pl-24">Score: {{ Math.round(score) }}</h1>

  </div>

           <div class=" absolute top-4 left-72 flex backdrop-blur-sm bg-white/30 rounded-3xl ">
               <Link data-te-toggle="tooltip" title="Back to quiz chooser" :href="route('choosequiz')" class="scrollbar-none flex text-2xl p-4  py-4 font-raleway text-white rounded-lg">
                   <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                       <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                   </svg>
               </Link> <br>
              </div>
            <button v-if="currentQ.current == questions.length - 1 && answered == 1" @click="router.get('/quizmap/show/' + questions[0].map_quiz_id)" class="w-32 h-24  text-2xl text-white absolute flex bottom-5 justify-center inset-x-[54rem]  backdrop-blur-3xl bg-white/30  hover:bg-lime-500/30 rounded-3xl pt-4">PLAY AGAIN</button>
            <button v-if="answered == 1 && currentQ.current != questions.length - 1" @click="nextQ" class="w-32 h-16  text-2xl text-white absolute flex bottom-5 justify-center inset-x-[54rem]  backdrop-blur-3xl bg-white/30  hover:bg-lime-500/30 rounded-3xl pt-4">NEXT</button>
            <form @submit.prevent="submit"><button type="submit" v-if="answered == 0 && currentQ.current != questions.length" :disabled="form.processing" class="w-32 h-16  text-2xl text-white absolute flex bottom-5 justify-center inset-x-[54rem] pt-4 backdrop-blur-3xl bg-white/30  hover:bg-lime-500/30 rounded-3xl">ANSWER</button></form>
          </GMapMarker>
          <div v-if="currentQ.current == questions.length - 1 && answered == 1" class="absolute inset-1/4 flex justify-between filter backdrop-blur-md bg-gray-300/30 p-1 items-center align-center rounded-3xl">

              <h1 class="font-raleway box-border text-4xl text-white rounded-lg font-bold pl-24">Game over!</h1>
              <ConfettiExplosion :particleCount="5000" v-if="currentQ.current == questions.length - 1 && answered == 1" />
              <h1 class="font-raleway box-border text-4xl text-lime-200 rounded-lg font-bold pl-24">Your score is: {{ Math.round(score) }}</h1>
              <Link data-te-toggle="tooltip" title="Back to quiz chooser" :href="route('choosequiz')" class="scrollbar-none flex text-2xl p-4  py-4 font-raleway text-white roun  ded-lg">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
                  </svg>
              </Link> <br>
           </div>
    </GMapMap>
</GuestLayout>
  </template>
