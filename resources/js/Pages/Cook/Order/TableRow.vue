<script setup>
import { Head, Link } from "@inertiajs/vue3";
import ChangeStatus from "@/Pages/Cook/Order/ChangeStatus.vue";
defineProps(["order"]);
</script>
<template>
    <td class="whitespace-nowrap pl-6 py-3 font-bold">      
        {{meal.id}}
    </td>
    <td class="whitespace-nowrap px-6 py-3 font-bold">
      
        <Link  :href="`/cook/order/${meal.id}`"  class="flex items-center j">
            <div class="w-16 h-16">
                <img
                    :src="meal_photo"
                    :alt="meal_photo"
                    class="w-full h-full object-cover rounded"
                />
            </div>
            <p class="pl-4 lg:pl-8">
                {{ meal.meal.name }}
            </p>
        </Link>
    </td>
    <td class="whitespace-nowrap px-6 py-3 font-semibold">
        {{ meal.user.name }}
    </td>
    <td class="whitespace-nowrap px-6 py-3 font-semibold">
        {{ meal.meal_time }}
    </td>
    <td class="whitespace-nowrap px-6 py-3 font-semibold">
        {{ meal.start_date }}
    </td>
    <td class="whitespace-nowrap px-6 py-3 font-semibold">
        {{ FormattedDate(meal.created_at)  }}
    </td>

    <td class="whitespace-nowrap px-6 py-3 text-center font-semibold">
        <div class="flex items-center">
            <p>
                {{ meal.status }}
            </p>
        </div>
    </td>
  
    <td class="whitespace-nowrap px-6 py-3 relative">
      <ChangeStatus :order="order" @status-update="updateStatus"></ChangeStatus>
       
    </td>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            meal: this.order,
            meal_photo: "",
        };
    },
    mounted() {
        this.FormattedDate();
        this.truncatedIng();
    },
    created() {
        this.getImage();
    },
    methods: {
        updateStatus(newStatus) {
            this.meal.status =  newStatus;
        },
      
        getImage() {
            const id = this.meal.meal.id;
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
