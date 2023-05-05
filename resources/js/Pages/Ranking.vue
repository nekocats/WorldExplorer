  <script setup lang="ts">
import { ref } from "vue";


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

<template>

  <div class="bg-materialgreen dark:bg-materialgreenbg justify-center w-full">
    <div class="flex flex-col mt-8">
      <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-black-200 shadow sm:rounded-lg">
          <table class="min-w-full ">
            <thead class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-lime-600 uppercase border-b border-gray-200 bg-materialgreenlight dark:bg-materialgreenbg bg-cover">
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
                <td class="px-6 py-4 border-b text-lime-600 bg-materialgreenlight dark:bg-materialgreenbg">
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
                <td class="px-6 py-4 text-sm leading-5 text-lime-600 border-b border-gray-200">
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