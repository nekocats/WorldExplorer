<script setup>

import { Link } from '@inertiajs/vue3';

const props = defineProps({
    quizzes: {
        type: Object,
        default: () => ({}),
    },
})
console.log(props.quizzes)
</script>
<template>
            <div class="flex flex-col pl-9 " :key="quiz.id" v-for="quiz in quizzes">
            <Link class="" :href="route('quizmap.show', quiz.id)" >{{ quiz.title }}</Link>
        </div>
</template>
