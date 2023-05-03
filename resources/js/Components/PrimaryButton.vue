<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-lime-600 border border-transparent rounded-md font-semibold text-xs text-white  uppercase tracking-widest hover:bg-lime-500 dark:hover:bg-lime-500 focus:bg-materialgreenbg dark:focus:bg-white active:bg-materialgreenbg dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
        <slot />
    </button>
</template>
