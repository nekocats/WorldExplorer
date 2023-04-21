<script setup>
import {Head, useForm} from '@inertiajs/vue3'
    import EditForm from './Edit.vue'
    import AppLayout from '@/Layouts/AppLayout.vue';

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
        formDel.delete(route('maps.destroy', id));
    }
}

</script>

<template>
    <Head title="Map Quiz Edit"/>
    <AppLayout>
    <GMapMap id="vue-map" ref="myMapRef" :center="center" :zoom="10" map-type-id="hybrid" style="width: 100vw; height: 20rem" @click="mark">
       <GMapMarker :key="marker.id" v-for="marker in markers" :position="{lat:marker.lat, lng:marker.lng}" :clickable="true"
          @click="openMarker(marker.id)" >
            <GMapInfoWindow
            :closeclick="true"
            @closeclick="openMarker(null)"
            :opened="openedMarkerID === marker.id"
        >
          <div> <span>{{marker.name}}</span>
            <p>{{marker.description}}</p>
        </div>

        <EditForm :marker = marker></EditForm>
        </GMapInfoWindow>
          </GMapMarker>
          <GMapMarker  :position="{lat:form.lat, lng:form.lng}">
          </GMapMarker>
    </GMapMap>
    <form @submit.prevent="form.post('store')">
    <div class="flex items-center text-center text-white fill-black bg-materialgreenbg p-6 text-2xl items-center justify-center">
        Question:
        <div class="p-2">
            <input class="text-white fill-black bg-materialgreenbg text-white border-4 border-lime-950 shadow-2xl shadow-lime-950 hover:shadow-lime-700 hover:border-lime-700 rounded-lg hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000" type="text" v-model="form.question">
        </div>
        Latitude:
        <div class="p-2">
            <input class="text-white fill-black bg-materialgreenbg text-white border-4 border-lime-950 shadow-2xl shadow-lime-950 hover:shadow-lime-700 hover:border-lime-700 rounded-lg hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000" type="text" v-model="form.lat">
        </div>
        Longitude:
        <div class="p-2">
            <input class="text-white fill-black bg-materialgreenbg text-white border-4 border-lime-950 shadow-2xl shadow-lime-950 hover:shadow-lime-700 hover:border-lime-700 rounded-lg hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000" type="text" v-model="form.lng">
        </div>


    </div>
    <div class="flex items-center text-center text-white justify-center">
                        <input class="p-6" type="file" name="images[]" multiple @input="form.images = $event.target.files" />
                    </div>

        <div class="flex p-6 justify-center items-center">
            <button class="text-white p-6 border-4 border-lime-950  text-2xl justify-center items-center shadow-2xl shadow-lime-950 hover:shadow-lime-700 hover:border-lime-700 rounded-lg hover:animate-pulse transition-all hover:transition-all duration-1000 hover:duration-1000" type="submit" :disabled="form.processing">Add new map data</button>

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
