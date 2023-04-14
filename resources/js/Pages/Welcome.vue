<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template class="bg">
    <Head title="Welcome" />
    <div class="relative bg-frontPageBg bg-cover grid justify-items-center items-center min-h-screen bg-dots-darker bg-center bg-orange-300 selection:bg-red-500 selection:text-white">
        <div v-if="canLogin" class="w-full rounded-b-[32px] bg-orange-200 sm:fixed  sm:top-0 sm:right-0 p-6 text-right">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-orange-900  dark:text-orange-900 text-[40px]">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="font-semibold text-orange-900 text-[40px]  dark:text-orange-900">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 font-semibold  text-[40px] text-orange-900  dark:text-orange-900 ">Register</Link>
            </template>
        </div>
        <div>
            <Link :href="route('map')" class="bg-orange-200 shadow-inner text-7xl text-orange-900 shadow-xl font-bold py-2 px-60 rounded-full">Play</Link> <br>
        </div>
    </div>
</template>
