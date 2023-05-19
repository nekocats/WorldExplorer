<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, onMounted } from "vue";
import axios from 'axios';

const users = ref([]);

onMounted(async () => {
  try {
    const response = await axios.get('/api/users');
    users.value = response.data;
    await fetchScores();
  } catch (error) {
    console.error(error);
  }
});

const fetchScores = async () => {
  try {
    const response = await axios.get('/api/scores');
    const scores = response.data;

    users.value.forEach((user) => {
      const userScores = scores.filter((score) => score.user_id === user.id);
      if (userScores.length > 0) {
        const highestScore = Math.max(...userScores.map((score) => score.score));
        user.score = highestScore.toFixed(0);
      }
    });

    users.value.sort((a, b) => b.score - a.score);
  } catch (error) {
    console.error(error);
  }
};

const getUserImageUrl = (imagePath) => {
  if (imagePath) {
    return `/storage/${imagePath}`;
  } else {
    return '/default-profile-photo.jpg';
  }
};
</script>

<template #header>
<AppLayout title="Ranking">

  <div class="relative  bg-materialgreenlight dark:bg-materialgreenbg bg-cover grid pl-20 pr-20 min-h-screen bg-center selection:bg-lime-950 selection:text-white">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          Leaderboard
      </h2>
    <div class="flex flex-col h-full w-full block">
      <div class="">
        <div class="inline-block w-full overflow-hidden shadow sm:rounded-lg">
          <table class="w-full h-full">
            <thead class=" text-xs font-medium leading-4 tracking-wider text-left text-lime-600 uppercase border-b border-lime-950 bg-materialgreenlight dark:bg-materialgreenbg bg-cover">
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
              <tr v-for="(u, index) in users" :key="index">
                <td class="px-20 py-4 border-b border-lime-950 text-lime-600 bg-materialgreenlight dark:bg-materialgreenbg">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 w-30 h-30 ">
                      <img  :src="getUserImageUrl(u.profile_photo_path)" alt="User Profile Photo" class="w-20 h-20 rounded-full  object-cover" />
                    </div>

                    <div class="ml-4">
                      <div class="text-[30px] font-medium leading-5 pl-6 text-lime-600">
                        {{ u.name }}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 text-[40px] leading-5 text-lime-600 border-b border-lime-950">
                  {{u.score}}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</AppLayout>
</template>