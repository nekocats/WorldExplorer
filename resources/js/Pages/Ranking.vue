<script setup> 
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from "vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

const testUser = {
  name: "Pneuma",
  score: "6996969"
}

const users = ref([...Array(10).keys()].map(() => testUser))


</script>
<script setup lang="ts">
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
                    <div class="flex-shrink-0 w-10 h-10">
                      <img class="w-10 h-10 rounded-full"
                        src="https://pbs.twimg.com/profile_images/1646588275245580289/GfyG6yxR_400x400.jpg" alt="" />
                    </div>

                    <div class="ml-4">
                      <div class="text-sm font-medium leading-5 text-lime-600">
                        {{ u.name }}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-lime-600 border-b border-lime-950">
                  {{ u.score }}
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