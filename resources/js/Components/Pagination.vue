<script setup>
import { Link }  from '@inertiajs/vue3';

defineProps({
    data: {
        type: Object,
        default: () => ({}),
    },
});
</script>


<template>
    <div v-if="data.links.length > 3" class="flex justify-center mt-4 space-x-4">
        <Link
            v-for="(link, k) in data.links"
            :key="k"
            class="px-4 py-3 text-lg leading-4 bg-materialgreenbg text-white hover:text-materialgreenbg font-semibold  rounded hover:bg-lime-500 focus:text-indigo-500 hover:shadow"
            :class="{'bg-white text-materialgreenbg': link.active}"
            :href="link.url"
            v-html="link.label"
        />
    </div>
</template>
