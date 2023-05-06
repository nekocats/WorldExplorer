<script setup> 
    import { Head, Link } from '@inertiajs/vue3';

    defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script><template>
    <Head title="Gamemode select"/>
    <div class="relative  bg-frontPageBg bg-cover grid justify-items-center items-center min-h-screen bg-dots-darker bg-center bg-materialgreenbg selection:bg-lime-950 selection:text-white">
        <div v-if="canLogin" class="w-full rounded-b-[32px] sm:fixed  sm:top-0 sm:right-0 p-6 text-right">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-shadow shadow-black text-[#7E4400] font-raleway text-lime-600 dark:text-lime-600 text-2xl">About</Link>

            <template v-else>
                <Link :href="route('login')" class="font-semibold text-gray-200 text-[40px]  dark:text-gray-200">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 font-semibold  text-[40px] text-lime-600  dark:text-lime-600 ">Register</Link>


            </template>
        </div> 

        <div>
            <h1 class="text-4xl font-bold tracking-tight text-lime-600 sm:text-6xl">Quiz Question Placeholder</h1>
        </div>

        <div class="flex">
            <a :href="route('gameselect')" class="rounded-md bg-lime-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-lime-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Answer placeholder</a>
            <a :href="route('gameselect')" class="rounded-md bg-lime-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-lime-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Answer placeholder</a>
        </div>

        <div class="flex">
            <a :href="route('gameselect')" class="rounded-md bg-lime-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-lime-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Answer placeholder</a>
            <a :href="route('gameselect')" class="rounded-md bg-lime-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-lime-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Answer placeholder</a>
        </div>
    </div>
</template>
