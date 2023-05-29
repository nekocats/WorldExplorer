<script setup>

import AppLayout from '@/Layouts/RankingLayout.vue';
import { ref, onMounted, watch } from "vue";
import {Link, router} from "@inertiajs/vue3";
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    users: {
        type: Object,
        default: () => ({}),
    },
    scores: {
        type: Object,
        default: () => ({}),
    },
})


const getUserImageUrl = (imagePath) => {
  if (imagePath) {
    return `/storage/${imagePath}`;
  } else {
    return '/default-profile-photo.jpg';
  }
};


let search = ref('');
watch(search, (value) => {
  router.get(
    "/quizmap/ranking/"+ props.scores.data[0].map_quiz_id,
    { search: value },
    {
      preserveState: true,
    }
  );
});
</script>

<template #header>
  <AppLayout title="Ranking">

    <div class="flex bg-materialgreenlight dark:bg-materialgreenbg bg-cover grid pl-20 pr-20 min-h-screen bg-center selection:bg-lime-950 selection:text-white">


      <div class="flex flex-col h-full w-full block">
        <!-- <input
                    type="text"
                    v-model="search"
                    placeholder="Search for a user..."
                    class="block text-white w-96 h-10 border-lime-500 bg-materialgreenbg focus:border-lime-500 focus:ring focus:ring-lime-200 focus:ring-opacity-50 rounded-md shadow-sm"
            /> -->
        <div>
          <div class="inline-block w-full overflow-hidden shadow sm:rounded-lg">
            <table class="w-full h-full">
              <thead class="text-xs font-medium leading-4 tracking-wider text-left text-lime-600 uppercase border-b border-lime-950 bg-materialgreenlight dark:bg-materialgreenbg bg-cover">
              <tr>
                <th class="pl-20">
                  Player:
                </th>
                <th class="pl-5">
                  Score
                </th>
              </tr>
              </thead>
              <tbody class="bg-materialgreenlight dark:bg-materialgreenbg">
              <tr v-for="score in scores.data" :key="score.id">
                <td class="px-20 py-4 border-b border-lime-950 text-lime-600 bg-materialgreenlight dark:bg-materialgreenbg">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 w-30 h-30">
                      <img alt="User Profile Photo" :src="getUserImageUrl(score.user.profile_photo_path)" class="w-20 h-20 rounded-full object-cover" />
                    </div>
                    <div class="ml-4">
                      <div class="text-[30px] font-medium leading-5 pl-6 text-lime-600">
                        <span>{{ score.user.name }}</span>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 text-[40px] leading-5 text-lime-600 border-b border-lime-950">
                  {{ Math.round(score.score) }}
                </td>
              </tr>
              </tbody>
            </table>
            <Pagination class="bg-materialgreenlight dark:bg-materialgreenbg" :data="scores" />
          </div>
        </div>
      </div>
    </div>

  </AppLayout>
</template>
