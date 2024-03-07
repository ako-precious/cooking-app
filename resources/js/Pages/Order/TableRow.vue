<script setup>
import { Head, Link } from "@inertiajs/vue3";
defineProps(["meal"]);
</script>
<template>
    
    <td class="whitespace-nowrap px-6 py-3 font-bold">
        <Link :href="`//${meal.id}`" class="flex items-center j">
            <p class="">
                {{ meal.meal.name }}
            </p>
        </Link>
    </td>
    <!-- <td class="whitespace-nowrap px-6 py-3">{{  meal.meal.id }}</td> -->
    <td class="whitespace-nowrap px-6 py-3 font-semibold">{{ getCook(meal.meal.id) }}</td>
    <td class="whitespace-nowrap px-6 py-3 font-semibold">{{ meal.meal_time }}</td>
    <td class="whitespace-nowrap px-6 py-3 font-semibold">
        {{ FormattedDate(meal.created_at) }}
    </td>

    <td class="whitespace-nowrap px-6 py-3 text-center font-semibold">
        <div class="flex items-center">
            <p>
                {{ meal.status }}
            </p>
        </div>
    </td>
   
    <td class="whitespace-nowrap px-6 py-3"> <div class=" bg text-xl z-20 flex items-center">
           
            <div v-if="meal.status == 'accept'">
                <Link :href="`/process_order/${meal.id}`" >
                    <div  class="p-2 cursor-pointer shadow-sm w-full hover:shadow-xs group "><p class="text-base font-semibold group-action-text capitalize ">Pay</p></div></Link>
            </div>            
            <div v-else-if="meal.status == 'delivered'">
                <div  @click="ChangeStatus('confirmed')"  class="p-2 cursor-pointer shadow-sm w-full hover:shadow-xs group "><p class="text-base font-semibold group-action-text capitalize ">Confirm</p></div>
            </div>
            <div v-else-if="meal.status == 'confirmed'">
                <div  class="p-2 cursor-pointer shadow-sm w-full hover:shadow-xs group "><p class="text-base font-semibold group-action-text capitalize ">Rate</p></div>
            </div>

        </div></td>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            meal_photo: "",
            user_name: ""
        };
    },
    created() {
        this.FormattedDate();
        this.truncatedIng();
        // this.getCook()
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
        getCook(id) {
            axios
                .get("/meal/" + id)
                .then((response) => {
                    // console.log("Data sent successfully:", response.data.meal);
                    this.user_name = response.data.meal.user.name;
                })
                .catch((error) => {
                    console.error("Error sending data:", error);
                });
                return this.user_name
        }, ChangeStatus(status) {
            axios
                .put("/cook/order/" + this.meal.id, { status })
                .then((response) => {
                    console.log("Data sent successfully:", response.data.order.status);
                    // this.meal.status = response.data.order.status
                })
                .catch((error) => {
                    console.error("Error sending data:", error);
                });
        },
    },
};
</script>
