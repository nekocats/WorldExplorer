<script setup>
    import {Head, Link, useForm, router} from '@inertiajs/vue3'
    const props = defineProps({
    quiz: {
        type: Object,
        default: () => ({}),
    },
    id: {
        type: Object,
        default: () => ({}),
    },
})
</script>

<template>
<Link :href="route('getQuestion', id)">Start</Link>
</template>
