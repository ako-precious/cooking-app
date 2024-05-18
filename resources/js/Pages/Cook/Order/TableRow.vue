<script setup>
import { Head, Link } from "@inertiajs/vue3";
defineProps(["order"]);
</script>
<template>
    <td class="whitespace-nowrap px-6 py-3 font-bold">
        <Link :href="``" class="flex items-center j">
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
        {{ FormattedDate(meal.created_at) }}
    </td>

    <td class="whitespace-nowrap px-6 py-3 text-center font-semibold">
        <div class="flex items-center">
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
    <td class="whitespace-nowrap px-6 py-3 relative">
        <!-- <button
            class="shadow-md rounded-md cursor-pointer w-[120px] h-[40px] text-oynx dark:text-snow font-semibold border-none flex justify-center items-center"
        >
            <span class="span-mother flex overflow-hidden">
                <span>Ch</span>
                <span>an</span>
                <span>ge S</span>
                <span>ta</span>
                <span>tu</span>
                <span>s</span>
            </span>
            <span class="span-mother2">
                <span>Ch</span>
                <span>an</span>
                <span>ge S </span>
                <span>ta</span>
                <span>tu</span>
                <span>s</span>
            </span>
        </button> -->
        <div v-if="isToday(meal.created_at) " class="bg text-xl z-20 flex items-center">
            <div v-if="meal.status == 'pending'" class="flex">
                <div
                    @click="ChangeStatus('accepted')"
                    class="mr-2 p-2 cursor-pointer shadow-sm w-full hover:shadow-xs group"
                >
                    <p
                        class="text-base font-semibold group-action-text capitalize"
                    >
                        accept
                    </p>
                </div>
                <div
                    @click="ChangeStatus('rejected')"
                    class="p-2 cursor-pointer shadow-sm w-full hover:shadow-xs group"
                >
                    <p
                        class="text-base font-semibold group-action-text capitalize"
                    >
                        reject 
                    </p>
                </div>
            </div>
            <div v-else-if="meal.status == 'processed'">
                <div
                    @click="ChangeStatus('ready')"
                    class="p-2 cursor-pointer shadow-sm w-full hover:shadow-xs group"
                >
                    <p
                        class="text-base font-semibold group-action-text capitalize"
                    >
                        ready
                    </p>
                </div>
            </div>
            <div v-else-if="meal.status == 'ready'">
                <div
                    @click="ChangeStatus('in transit')"
                    class="p-2 cursor-pointer shadow-sm w-full hover:shadow-xs group"
                >
                    <p
                        class="text-base font-semibold group-action-text capitalize"
                    >
                        in transit
                    </p>
                </div>
            </div>
            <div v-else-if="meal.status == 'in transit'">
                <div
                    @click="ChangeStatus('delivered')"
                    class="p-2 cursor-pointer shadow-sm w-full hover:shadow-xs group"
                >
                    <p
                        class="text-base font-semibold group-action-text capitalize"
                    >
                        delivered
                    </p>
                </div>
            </div>
        </div>
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
        this.isToday();
    },
    created() {
        this.getImage();
    },
    methods: {
        isToday(dateString) {
      const date = new Date(dateString);
      const today = new Date();
      return date.toDateString() <= today.toDateString();
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
        ChangeStatus(status) {
            axios
                .put("/cook/order/" + this.meal.id, { status })
                .then((response) => {
                    // console.log("Data sent successfully:", response.data.order.status);
                    this.meal.status = response.data.order.status;
                })
                .catch((error) => {
                    console.error("Error sending data:", error);
                });
        },
    },
};
</script>
