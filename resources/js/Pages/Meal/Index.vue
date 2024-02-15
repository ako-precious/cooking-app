<script setup>
import { Head, Link } from "@inertiajs/vue3";


</script>

<template>
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-white"
    >
        <div class="container relative mx-auto overflow-hidden">
            <div
                class="m-auto flex flex-col max-w-[1000px] justify-center h-full px-6 lg:pb-20 w-full"
            >
                <div class="py-5 lg:pb-12">
                    <h1
                        class="font-semibold text-2xl text-center lg:text-4xl text-oynx dark:text-snow"
                    >
                        Continue to create your menu
                    </h1>
                </div>
                <div class="lg:w-full">
                    <div class="flex flex-col w-full">
                        <div class="grid grid-cols-1 gap-5 lg:gap-8 lg:px-10">
                            <!-- TW Elements is free under AGPL, with commercial license required for specific uses. See more details: https://tw-elements.com/license/ and contact us for queries at tailwind@mdbootstrap.com --> 
<div class="flex flex-col overflow-x-auto">
  <div class="sm:-mx-6 lg:-mx-8">
    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
      <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm font-light">
          <thead class="border-b font-medium dark:border-neutral-500">
            <tr>
              <th scope="col" class="px-6 py-4">#</th>
              <th scope="col" class="px-6 py-4">Heading</th>
              <th scope="col" class="px-6 py-4">Heading</th>
              <th scope="col" class="px-6 py-4">Heading</th>
              <th scope="col" class="px-6 py-4">Heading</th>
              <th scope="col" class="px-6 py-4">Heading</th>
              <th scope="col" class="px-6 py-4">Heading</th>
              <th scope="col" class="px-6 py-4">Heading</th>
              <th scope="col" class="px-6 py-4">Heading</th>
            </tr>
          </thead>
          <tbody>
            <tr class="border-b dark:border-neutral-500">
              <td class="whitespace-nowrap px-6 py-4 font-medium">1</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
            </tr>
            <tr class="border-b dark:border-neutral-500">
              <td class="whitespace-nowrap px-6 py-4 font-medium ">2</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4 ">Cell</td>
              <td class="whitespace-nowrap px-6 py-4 ">Cell</td>
            </tr>
            <tr class="border-b ">
              <td class="whitespace-nowrap px-6 py-4 font-medium ">3</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
              <td class="whitespace-nowrap px-6 py-4">Cell</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
                            <div
                                v-for="(item, index) in menu"
                                :key="index"
                                class="col-span-1 w-full max-w-full"
                            >
                                <div
                                    class="flex min-w-0 break-words w-full items-center justify-between shadow-reverse group rounded-2xl bg-clip-border cursor-pointer"
                                >
                                    <Link class="w4"
                                        :href="`/become-a-cook/${item.id}/overview`"
                                    >
                                        <div
                                            class="relative flex items-center justify-between w-full p-4 mb-0 list-none rounded-xl"
                                        >
                                            <font-awesome-icon
                                                class="lg:text-2xl leading-normal"
                                                icon="bowl-rice"
                                            />
                                            <div class="w-full">
                                                <p
                                                    class="font-semibold px-4 py-2 transition-colors ease-in-out rounded-lg group-action-text"
                                                >
                                                    <span
                                                        v-if="item.name"
                                                        class="lg:text-xl leading-normal"
                                                    >
                                                        {{ item.name }}</span
                                                    >
                                                    <span
                                                        v-else
                                                        class="lg:text-xl leading-normal"
                                                        >Food created on
                                                        {{
                                                            FormattedDate(
                                                                item.created_at
                                                            )
                                                        }}
                                                    </span>
                                                </p>
                                            </div>
                                            <div></div>
                                        </div>
                                    </Link>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    props: {
        menu: Object,
    },
    created() {
        this.FormattedDate();
    },
    methods: {
        
        FormattedDate(timestamp) {
            const date = new Date(timestamp);
            const formattedDate = `${date.getFullYear()}-${(date.getMonth() + 1)
                .toString()
                .padStart(2, "0")}-${date
                .getDate()
                .toString()
                .padStart(2, "0")} at ${date.getHours()}:${date
                .getMinutes()
                .toString()
                .padStart(2, "0")}`;
            return formattedDate;
        },

       
    },
};
</script>

<style scoped>
@keyframes fade-in {
    from {
        opacity: 0;
        bottom: -10rem;
    }
    to {
        opacity: 1;
        bottom: 0;
    }
}

.animate-fade-in {
    animation: fade-in 0.7s ease-in;
}
</style>
