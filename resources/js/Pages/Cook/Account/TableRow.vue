<script setup>
import { Head, Link } from "@inertiajs/vue3";
defineProps(["meal"]);
</script>
<template>
    <td v-if="meal.name" class="whitespace-nowrap pl-6 py-3 font-semibold">
        <Link :href="`/cook/menu/edit`" class="flex items-center j">
            
            <div class="w-16 h-16 ">
                <img
                    :src="meal_photo"
                    :alt="meal_photo"
                    class=" w-full h-full object-cover rounded"
                />
            </div>
            <p class="pl-4 lg:pl-8">

                {{ meal.name }}
            </p>
        </Link>
    </td>
    <td v-else class="whitespace-nowrap pl-6 py-3 font-semibold">
        <Link :href="`/become-a-cook/${meal.id}/overview`" class="flex items-center j">
            <div class="w-16 h-16 p-4 ">
                <font-awesome-icon icon="image" class=" w-full h-full object-cover rounded text-persian "/>
                  
            </div>

            <p class=" pl-4 lg:pl-8">

                Meal created on {{ FormattedDate(meal.created_at) }}
            </p>
        </Link>
    </td>
    <td class="whitespace-nowrap px-6 py-3">{{ meal.status }}</td>
    <td class="whitespace-nowrap px-6 py-3">$ {{ meal.price }}</td>

    <td
        v-if="meal.ordering_preferences == 'automatic'"
        class="whitespace-nowrap px-6 py-3 text-center"
    >
    <div class=" flex items-center ">
        <font-awesome-icon class="text-persian text-lg pr-1" icon="toggle-on" />
       <p>
        On
       </p> 

    </div>
    </td>
    <td v-else class="whitespace-nowrap px-6 py-3 ">
        <div class=" flex items-center ">
            <font-awesome-icon
                class="text-persian text-lg pr-1"
                icon="toggle-off"
            />
            Off
        </div>
    </td>
    <td class="whitespace-nowrap px-6 py-3"></td>
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
                        (this.meal_photo =`/storage/${response.data.firstPhoto.meal_photo_path}`.replace("/public",""))                       
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
    },
};
</script>
