<script setup>
import {Head, useForm} from '@inertiajs/vue3'
import EditForm from './Edit.vue'
import AppLayout from '@/Layouts/AppLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

const props = defineProps({
    markers: {
        type: Object,
        default: () => ({}),
    },
    quiz: {
        type: Object,
        default: () => ({}),
    },
})

console.log(props.quiz)
console.log(props.markers[0].questions)
console.log(props.markers)
    const form = useForm({
  question: null,
  lat: null,
  lng: null,
  images: null,
  map_quiz_id: props.quiz,
})

const formDel = useForm({});
function mark(event) {
    form.lat = event.latLng.lat()
    form.lng = event.latLng.lng()

  }
function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        formDel.delete(route('quizmap.destroy', id));
    }
}

</script>

<template>
    <Head title="Map Quiz Edit"/>
    <AppLayout>
    <GMapMap id="vue-map" ref="myMapRef" :center="center" :zoom="10" map-type-id="hybrid" style="width: 100vw; height: 33rem" @click="mark">
       <GMapMarker :key="marker.id" v-for="marker in markers[0].questions" :position="{lat:marker.lat, lng:marker.lng}" :clickable="true"
          @click="openMarker(marker.id)" >
            <GMapInfoWindow
            :closeclick="true"
            @closeclick="openMarker(null)"
            :opened="openedMarkerID === marker.id"
        >
          <div> <span>{{marker.name}}</span>
            <p>{{marker.description}}</p>
        </div>

        <h1 class="pb-3">{{ marker.question }}</h1>
        <DangerButton @click="destroy(marker.id)">DELETE</DangerButton>
        </GMapInfoWindow>
          </GMapMarker>
          <GMapMarker  :position="{lat:form.lat, lng:form.lng}">
          </GMapMarker>
    </GMapMap>
    <form @submit.prevent="form.post('store')">
    <div class="flex items-center text-center text-white fill-black bg-materialgreenbg p-5 text-xl items-center justify-center">
        Question:
        <div class="p-2">
            <textarea v-model="form.question" placeholder="Question" class="block text-white w-full border-lime-500 bg-materialgreenbg focus:border-lime-500 focus:ring focus:ring-lime-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
        </div>
        Latitude:
        <div class="p-2">
            <textarea v-model="form.lat" placeholder="Latitude" class="block text-white w-full border-lime-500 bg-materialgreenbg focus:border-lime-500 focus:ring focus:ring-lime-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
           </div>
        Longitude:
        <div class="p-2">
            <textarea v-model="form.long" placeholder="Longitude" class="block text-white w-full border-lime-500 bg-materialgreenbg focus:border-lime-500 focus:ring focus:ring-lime-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>

        </div>


    </div>
    <div class="flex items-center text-center text-white justify-center">
                        <input class="p-2 c" type="file" name="images[]" multiple @input="form.images = $event.target.files" />
                    </div>

        <div class="flex p-6 justify-center items-center">
            <PrimaryButton class="mt-4 p-6 " type="submit" :disabled="form.processing">Add new map data</PrimaryButton>

        </div>
    </form>
</AppLayout>
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
