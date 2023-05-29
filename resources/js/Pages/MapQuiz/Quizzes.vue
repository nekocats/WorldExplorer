<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { useForm, usePage, Head, Link } from '@inertiajs/vue3';
const props = defineProps({

    quizzes: {
        type: Object,
        default: () => ({}),
    },
})

console.log(props.quizzes)

const form = useForm({
    title: '',
    description: '',
    user_id: usePage().props.auth.user.id,
});

const formDel = useForm({});
function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        formDel.delete(route('destroyMapQuiz', id));
    }
}
</script>

<template>
    <Head title="Quiz"/>
    <AppLayout title="Add map data">
        <div class="max-w-2xl mx-auto p-8 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('mapquiz.store'), { onSuccess: () => form.reset() })">
                <h2 class="text-lime-700 dark:text-lime-500 text-3xl font-bold">
                    Add map data
                </h2>
                <div class="py-6 text-white">
                    <input placeholder="Title" type="text" v-model="form.title" class="block w-full border-lime-500 bg-materialgreenlight dark:bg-materialgreenbg focus:border-lime-500 focus:ring focus:ring-lime-200 focus:ring-opacity-50 rounded-md shadow-sm">
                </div>

                <textarea v-model="form.description" placeholder="Description" class="block text-white w-full border-lime-500 bg-materialgreenlight dark:bg-materialgreenbg focus:border-lime-500 focus:ring focus:ring-lime-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>
                <InputError :message="form.errors.title" class="mt-2" />
                <PrimaryButton class="mt-4 p-6 ">Add</PrimaryButton>
            </form>

        </div>
        <div class="flex flex-col items-center text-lime-700 dark:text-lime-500" :key="quiz.id" v-for="quiz in quizzes">
            <Link class="text-lime-200 text-3xl p-2" :href="route('quizmap.getQuiz', quiz.id)" >{{ quiz.title }}</Link>
            <DangerButton @click="destroy(quiz.id)">DELETE</DangerButton>
        </div>

    </AppLayout>
</template>
