<script setup>
import { Head, Link } from "@inertiajs/vue3";

import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
defineProps(["meal"]);
</script>
<template>
    <td v-if="meal.name" class="whitespace-nowrap pl-6 py-3 font-semibold">
        <div class="flex items-center j">
            <div class="w-16 h-16">
                <Link :href="`/become-a-cook/${meal.id}/photos`">
                    <img
                        :src="meal_photo"
                        :alt="meal_photo"
                        class="w-full h-full object-cover rounded"
                    />
                </Link>
            </div>
            <Link :href="`/become-a-cook/${meal.id}/meal-title`">
                <p class="pl-4 lg:pl-8">
                    {{ meal.name }}
                </p>
            </Link>
        </div>
    </td>
    <td v-else class="whitespace-nowrap pl-6 py-3 font-semibold">
        <div
            :href="`/become-a-cook/${meal.id}/overview`"
            class="flex items-center j"
        >
            <Link :href="`/become-a-cook/${meal.id}/photos`">
                <div class="w-16 h-16 p-4">
                    <font-awesome-icon
                        icon="image"
                        class="w-full h-full object-cover rounded text-persian"
                    />
                </div>
            </Link>
            <Link :href="`/become-a-cook/${meal.id}/meal-title`">
                <p class="pl-4 lg:pl-8">
                    Meal created on {{ FormattedDate(meal.created_at) }}
                </p>
            </Link>
        </div>
    </td>
    <td class="whitespace-nowrap px-6 py-3">
        <Link :href="`/become-a-cook/${meal.id}/cook-limit`">{{
            meal.cooking_limit
        }}</Link>
    </td>

    <td class="whitespace-nowrap px-6 py-3  overflow-y-scroll max-h-24">
        <Link :href="`/become-a-cook/${meal.id}/price`"
            > <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <thead>
          <tr class="bg-gray-200 dark:bg-gray-700">
            <th class="py-3 px-6 text-left text-xs font-medium  uppercase tracking-wider">Size</th>
            <th class="py-3 px-6 text-left text-xs font-medium  uppercase tracking-wider">Unit</th>
            <th class="py-3 px-6 text-left text-xs font-medium  uppercase tracking-wider">Price</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(mealPrice, index) in  meal.prices" :key="index" class="border-b ">
            <td class="py-4 px-6 whitespace-nowrap">{{ mealPrice.size }}</td>
            <td class="py-4 px-6 whitespace-nowrap">{{ mealPrice.unit }}</td>
            <td class="py-4 px-6 whitespace-nowrap">${{ mealPrice.price }}</td>
          </tr>
        </tbody>
      </table></Link
        >
    </td>
    <td v-if="meal.ingredients"  class="whitespace-nowrap px-6 py-3">
        <Link :href="`/become-a-cook/${meal.id}/ingredients`"
            >
           
      <p v-for="(ingredient, index) in mealIngredients(meal.ingredients)" :key="index">
        {{ ingredient }}, 
      </p>
    and more
            </Link

        >
    </td><td v-else class="whitespace-nowrap px-6 py-3">Add ingredients</td>

    <td
        v-if="meal.ordering_preferences == 'automatic'"
        class="whitespace-nowrap px-6 py-3 text-center"
    >
        <Link :href="`/become-a-cook/${meal.id}/ordering-preference`">
            <div class="flex items-center">
                <font-awesome-icon
                    class="text-persian text-lg pr-1"
                    icon="toggle-on"
                />
                <p>On</p>
            </div></Link
        >
    </td>
    <td v-else class="whitespace-nowrap px-6 py-3">
        <Link :href="`/become-a-cook/${meal.id}/ordering-preference`">
            <div class="flex items-center">
                <font-awesome-icon
                    class="text-persian text-lg pr-1"
                    icon="toggle-off"
                />
                Off
            </div></Link
        >
    </td>
    <td class="whitespace-nowrap px-6 py-3">{{ meal.status }}</td>
    <td
        v-if="
            meal.name &&
            meal.ordering_preferences &&
            meal.price &&
            meal.cooking_limit &&
            meal.ingredients &&
            meal.region &&
            meal.description
        "
        class="whitespace-nowrap px-6 py-3 cursor-pointer font-semibold"
    >
        <Dropdown align="right" width="48">
            <template #trigger>
                <div
                    class="p-2 cursor-pointer shadow-sm w-full hover:shadow-xs group"
                >
                    <p
                        class="text-base text-center font-semibold group-action-text capitalize"
                    >
                        Change Status
                    </p>
                </div></template
            >

            <template #content class="bg-snow dark:bg-oynx">
                <div
                    class="origin-top-right absolute right-0 mt-2 w-48 delay-75 rounded-md border-snow ring-1 bg-gradient-to-br from-[#e3dedf] to-[#ffffff] -shadow-snow-sm hover:shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] dark:-shadow-oynx-sm hover:dark:shadow-oynx-sm z-20 transition-all duration-250 ease-in dark:border-oynx"
                >
                    <DropdownLink
                        href="#"
                        @click="sendData('unavailable', meal.id)"
                        class="relative flex items-center rounded-md px-4 py-2 text-sm text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                    >
                        <p>Unavailable</p>
                    </DropdownLink>
                    <DropdownLink
                        href="#"
                        @click="sendData('available', meal.id)"
                        :href="'profile.show'"
                        class="relative flex items-center rounded-md px-4 py-2 text-sm text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                    >
                        <a>
                            <p>Available</p>
                        </a>
                    </DropdownLink>
                </div>
            </template>
        </Dropdown>
    </td>
    <td v-else class="whitespace-nowrap px-6 py-3">
        <Link :href="`/become-a-cook/${meal.id}/overview`"> <div
                    class="p-2 cursor-pointer shadow-sm w-full hover:shadow-xs group"
                >
                    <p
                        class="text-base text-center font-semibold group-action-text capitalize"
                    >
                        Finish Setup
                    </p>
                </div></Link>
    </td>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            meal_photo: "",
        };
    },
    created() {
        this.getImage();
    },
    mounted() {
        this.FormattedDate();
        this.truncatedIng();
    },
    methods: {
        FormattedDate(timestamp) {
            const date = new Date(timestamp);
            const formattedDate = `${date.getFullYear()}-${(date.getMonth() + 1)
                .toString()
                .padStart(2, "0")}-${date
                .getDate()
                .toString()
                .padStart(2, "0")}`;
            return formattedDate;
        },
        getImage() {
            const id = this.meal.id;
            axios
                .get(`/meal_photos/${id}`)
                .then((response) => {
                    if (response.data.firstPhoto.meal_photo_path) {
                        this.meal_photo =
                            `/storage/${response.data.firstPhoto.meal_photo_path}`.replace(
                                "/public",
                                ""
                            );
                    }
                })
                .catch((error) => {
                    // Handle error
                    // console.error("Error saving data:", error);
                });
        },
        truncatedIng(description) {
            // Check if description exists and has more than 30 characters
            if (description && description.length > 1) {
                // Truncate description to 30 characters and add ellipsis
                return description.slice(0, 1) + "...";
            } else {
                // Return full description if it's less than or equal to 30 characters
                return description;
            }
        },
        mealIngredients(ingredients) {
      // Return the first two items from meal.ingredients
      return ingredients.slice(0, 2);
    },
        sendData(status, id) {
            // Perform an HTTP request to send the data to the server
            axios
                .put("/meal/status/" + id, { status })
                .then((response) => {
                    this.$inertia.visit(`/cook/menu`);
                })
                .catch((error) => {
                    // console.error("Error sending data:", error);
                });
        },
    },
};
</script>
