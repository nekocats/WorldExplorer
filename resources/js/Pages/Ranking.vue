<script setup lang="ts">
import { ref } from "vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

interface User {
  name: string;
  score: string;
}

const testUser: User = {
  name: "Pneuma",
  score: "6996969",
};

const users = ref<User[]>([...Array(10).keys()].map(() => testUser));

</script>

<template class="bg">  
  <div class="relative  bg-materialgreenlight dark:bg-materialgreenbg bg-cover grid justify-items-center items-center min-h-screen bg-center selection:bg-lime-950 selection:text-white">
    <div class="flex flex-col h-full w-full block">
      <div class="">
        <div class="inline-block w-full overflow-hidden shadow sm:rounded-lg">
          <table class="w-full h-full">
            <thead class=" text-xs font-medium leading-4 tracking-wider text-left text-lime-600 uppercase border-b border-black bg-materialgreenlight dark:bg-materialgreenbg bg-cover">
              <tr>
                <th>
                  Name
                </th>
                <th>
                  Score
                </th>
              </tr>
            </thead>

            <tbody class="bg-materialgreenlight dark:bg-materialgreenbg">
              <tr v-for="(u, index) in users" :key="index">
                <td class="px-6 py-4 border-b border-black text-lime-600 bg-materialgreenlight dark:bg-materialgreenbg">
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
                <td class="px-6 py-4 text-sm leading-5 text-lime-600 border-b border-black">
                  {{ u.score }}
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>