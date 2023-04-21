<script setup>
    import { useForm } from '@inertiajs/vue3'
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



    if (gameOver == false && answer.value <= 5000) {
        score.value = score.value + 5000
    } else if(gameOver == false && answer.value > 5000 && answer.value < 10000) {
        score.value = 10000 - Math.round(answer.value)
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

<template>
    <GuestLayout>
    <GMapMap id="vue-map" ref="myMapRef" :center="center" :zoom="10" map-type-id="terrain" style="width: 100vw; height: 20rem" @click="mark">
       <GMapMarker :position="{lat:guess.lat, lng:guess.lng}" :clickable="true"
          @click="openMarker(marker.id)" >

          <div>

        </div>

          </GMapMarker>
          <!-- <GMapMarker  :position="{lat:form.lat, lng:form.lng}">
          </GMapMarker> -->
    </GMapMap>
    <div>
        <h1>{{ questions[currentQ.current].question }}</h1>
        <h1>{{ score }}</h1>
    </div>
</GuestLayout>
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
