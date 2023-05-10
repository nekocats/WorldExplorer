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

})
console.log(props.quiz)
console.log(props.questions)


watch(
  () => props.distance,
  () => {
    console.log(props.distance)
  }
)
watch(
  () => props.currentQuestion,
  () => {
    console.log(props.currentQuestion)
  }
)
const score = ref(0)
console.log(props.quiz)
const questions = reactive([])
props.questions.forEach(element => {
questions.push(element)
});
const qCount = questions.length
const currentQ = ref({current: props.currentQuestion})
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


  function submit() {

  router.get('/quizmap/show/2', form, {
    preserveState: true,

  })
}
function nextQ() {
    currentId.value++
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
        <h1 class="dark:text-shadow shadow-black font-raleway box-border text-5xl dark:text-white">{{ questions[currentId].question }}</h1>
        <h1 class="dark:text-shadow shadow-black font-raleway box-border text-5xl text-lime-700  rounded-lg font-bold pr-10">Score: {{ distance }}</h1>

    </div>
    <GuestLayout class="scrollbar-none">
    <GMapMap id="vue-map" ref="myMapRef" :center="center" :zoom="10" map-type-id="hybrid" style="width: 100vw; height: 45rem" @click="gMark">

       <GMapMarker :position="{lat:form.lat, lng:form.lng}">
        <button @click="nextQ" class="w-64 h-36 text-3xl">NEXT</button>
          <GMapInfoWindow :opened="true" :closeclick="false">
            <form @submit.prevent="submit">

        <div class="flex p-6 justify-center items-center">
            <button class="p-6 border-4 border-lime-950  text-2xl justify-center items-center shadow-2xl shadow-lime-950 hover:shadow-lime-700 hover:border-lime-700 rounded-lg hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000" type="submit" :disabled="form.processing">Submit</button>

        </div>
    </form>
      </GMapInfoWindow>

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
