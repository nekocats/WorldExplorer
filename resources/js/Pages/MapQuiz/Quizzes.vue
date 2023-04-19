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
    <AppLayout title="Dashboard">
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('mapquiz.store'), { onSuccess: () => form.reset() })">
                <input placeholder="Title" type="text" v-model="form.title" class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                <textarea
                    v-model="form.description"
                    placeholder="Description"
                    class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <div class="flex items-center text-center">
                        <input type="file" name="images[]" multiple @input="form.images = $event.target.files" />
                    </div>
                <InputError :message="form.errors.title" class="mt-2" />
                <PrimaryButton class="mt-4">Add</PrimaryButton>
            </form>

        </div>
        <div class="flex flex-col" :key="quiz.id" v-for="quiz in quizzes">
            <Link class="text-white" :href="route('')" >{{ quiz.title }}</Link>
        </div>

    </AppLayout>
</template>
