<script setup>
    import { useForm } from '@inertiajs/vue3'
    import EditForm from './Edit.vue'

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
console.log(props.markers)
    const form = useForm({
  question: null,
  lat: null,
  lng: null,
  images: null,
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

    <GMapMap id="vue-map" ref="myMapRef" :center="center" :zoom="10" map-type-id="terrain" style="width: 100vw; height: 20rem" @click="mark">
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
    <form @submit.prevent="form.post('/add-marker')">
    <input type="text" v-model="form.question">
    <input type="text" v-model="form.lat">
    <input type="text" v-model="form.lng">
    <div class="flex items-center text-center">
                        <input type="file" name="images[]" multiple @input="form.images = $event.target.files" />
                    </div>
    <button type="submit" :disabled="form.processing">Submit</button>
  </form>

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
