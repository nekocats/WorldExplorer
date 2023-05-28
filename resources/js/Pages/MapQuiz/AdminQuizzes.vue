<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import Pagination  from '@/Components/Pagination.vue';
import { useForm, usePage, Head, Link, router } from '@inertiajs/vue3';
import { ref, watch } from "vue";
const props = defineProps({

    quizzes: {
        type: Object,
        default: () => ({}),
    },
})

console.log(props.quizzes)
let search = ref('');
watch(search, (value) => {
  router.get(
    "/admin/mapquizzes",
    { search: value },
    {
      preserveState: true,
    }
  );
});
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
    <AppLayout title="Dashboard">
        <div class="max-w-2xl mx-auto p-8 sm:p-6 lg:p-8">
            <form @submit.prevent="form.post(route('mapquiz.store'), { onSuccess: () => form.reset() })">

                <div class="py-6 text-white">
                    <input placeholder="Title" type="text" v-model="form.title" class="block w-full border-lime-500 bg-materialgreenbg focus:border-lime-500 focus:ring focus:ring-lime-200 focus:ring-opacity-50 rounded-md shadow-sm">
                </div>

                <textarea
                    v-model="form.description"
                    placeholder="Description"
                    class="block text-white w-full border-lime-500 bg-materialgreenbg focus:border-lime-500 focus:ring focus:ring-lime-200 focus:ring-opacity-50 rounded-md shadow-sm"
                ></textarea>
                <InputError :message="form.errors.title" class="mt-2" />
                <PrimaryButton class="mt-4 p-6 ">Add</PrimaryButton>
            </form>
            <input
                                    type="text"
                                    v-model="search"
                                    placeholder="Search..."
                                    class="bg-gray-50 border  mt-6 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-60 p-2.5 "
                                />


        </div>
        <div class="flex justify-center items-center" :key="quiz.id" v-for="quiz in quizzes.data">
            <Link class="text-lime-100 text-3xl p-2" :href="route('quizmap.getQuiz', quiz.id)" >{{ quiz.title }}</Link>
            <DangerButton @click="destroy(quiz.id)">DELETE</DangerButton>
        </div>
        <Pagination :data="quizzes" />
    </AppLayout>
</template>
