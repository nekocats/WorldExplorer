<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head, Link } from '@inertiajs/vue3';
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
    images: null,
});
</script>

<template>
    <Head title="Quiz"/>
    <AppLayout title="Dashboard">
        <div class="max-w-2xl mx-auto p-8 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('mapquiz.store'), { onSuccess: () => form.reset() })">

                <div class="py-6">
                    <input placeholder="Title" type="text" v-model="form.title" class="block w-full border-lime-500 bg-materialgreenbg focus:border-lime-500 focus:ring focus:ring-lime-200 focus:ring-opacity-50 rounded-md shadow-sm">
                </div>

                <textarea
                    v-model="form.description"
                    placeholder="Description"
                    class="block w-full border-lime-500 bg-materialgreenbg focus:border-lime-500 focus:ring focus:ring-lime-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <div class="flex items-center text-center">
                        <input type="file" name="images[]" multiple @input="form.images = $event.target.files" class="py-6 text-lime-100"/>
                    </div>
                <InputError :message="form.errors.title" class="mt-2" />
                <PrimaryButton class="mt-4 p-6 ">Add</PrimaryButton>
            </form>

        </div>
        <div class="flex flex-col items-center" :key="quiz.id" v-for="quiz in quizzes">
            <Link class="text-lime-100 text-3xl p-2" :href="route('quizmap.getQuiz', quiz.id)" >{{ quiz.title }}</Link>
        </div>

    </AppLayout>
</template>
