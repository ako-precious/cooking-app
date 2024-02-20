<script setup>
import { Head, Link } from "@inertiajs/vue3";
defineProps(["meal"]);
</script>
<template>
    
    <td class="whitespace-nowrap px-3 py-3 font-semibold">
        <Link :href="`/become-a-cook/${meal.id}/overview`" class="flex items-center j">
          
            <p class=" pl-4 lg:pl-8">

                {{ meal.meal.name }}
            </p>
        </Link>
    </td>
    <td class="whitespace-nowrap px-3 py-3">{{ meal.user.name }}</td>
    <td class="whitespace-nowrap px-3 py-3"> {{ meal.meal_time }}</td>
    <td class="whitespace-nowrap px-3 py-3">  {{ FormattedDate(meal.created_at) }}</td>

    <td             class="whitespace-nowrap px-3 py-3 text-center">
    <div class=" flex items-center ">
        
       <p>
        {{ meal.status }}
       </p> 

    </div>
    </td>
    <!-- <td v-else class="whitespace-nowrap px-6 py-3 ">
        <div class=" flex items-center ">
            <font-awesome-icon
                class="text-persian text-lg pr-1"
                icon="toggle-off"
            />
            Off
        </div>
    </td> -->
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
