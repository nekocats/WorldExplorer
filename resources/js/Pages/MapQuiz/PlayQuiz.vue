<script setup>
    import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    quiz: {
        type: Object,
        default: () => ({}),
    },
})
console.log(props.quiz)


function mark(event) {
event.latLng.lat()
event.latLng.lng()

  }


</script>

<template>
    <GuestLayout>
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


        </GMapInfoWindow>
          </GMapMarker>
          <!-- <GMapMarker  :position="{lat:form.lat, lng:form.lng}">
          </GMapMarker> -->
    </GMapMap>
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
