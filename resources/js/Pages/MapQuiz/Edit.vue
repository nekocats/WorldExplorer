<script setup>
    import { useForm } from '@inertiajs/vue3'
const props = defineProps({
    marker: {
        type: Object,
        default: () => ({}),
    },
})
const Editform = useForm({
  id: props.marker.id,
  name: props.marker.name,
  lat: props.marker.lat,
  lng: props.marker.lng,
  description: props.marker.description
})
</script>
<template>
        <form @submit.prevent="Editform.put(route('maps.update', props.marker.id))">
    <input type="text" v-model="Editform.name">
    <input type="text" v-model="Editform.lat">
    <input type="text" v-model="Editform.lng">
    <input type="text" v-model="Editform.description">
    <button type="submit" :disabled="Editform.processing">Submit</button>
  </form>
</template>
