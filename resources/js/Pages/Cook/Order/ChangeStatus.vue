<script setup>
defineProps(["order"]);
</script>
<template>
    <div
        v-if="checkIfTodayOrAfter(meal.start_date)"
        class="bg text-xl z-20 flex items-center"
    >
        <div v-if="meal.status == 'pending'" class="flex">
            <div
                @click="ChangeStatus('accepted')"
                class="mr-2 p-2 cursor-pointer shadow-sm w-full hover:shadow-xs group"
            >
                <p class="text-base font-semibold group-action-text capitalize">
                    accept
                </p>
            </div>
            <div
                @click="ChangeStatus('rejected')"
                class="p-2 cursor-pointer shadow-sm w-full hover:shadow-xs group"
            >
                <p class="text-base font-semibold group-action-text capitalize">
                    reject
                </p>
            </div>
        </div>
        <div v-else-if="meal.status == 'processed'">
            <div
                @click="ChangeStatus('ready')"
                class="p-2 cursor-pointer shadow-sm w-full hover:shadow-xs group"
            >
                <p class="text-base font-semibold group-action-text capitalize">
                    ready
                </p>
            </div>
        </div>
        <div v-else-if="meal.status == 'ready'">
            <div
                @click="ChangeStatus('in transit')"
                class="p-2 cursor-pointer shadow-sm w-full hover:shadow-xs group"
            >
                <p class="text-base font-semibold group-action-text capitalize">
                    in transit
                </p>
            </div>
        </div>
        <div v-else-if="meal.status == 'in transit'">
            <div
                @click="ChangeStatus('delivered')"
                class="p-2 cursor-pointer shadow-sm w-full hover:shadow-xs group"
            >
                <p class="text-base font-semibold group-action-text capitalize">
                    delivered
                </p>
            </div>
        </div>
    </div>
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
    emits: ["statusUpdate"],
    methods: {
        checkIfTodayOrAfter(dateString) {
            const start_date = new Date(dateString);
            const parsedDate = new Date(
                start_date.getTime() + 1000 * 60 * 60 * 24
            );
            return parsedDate >= new Date();
        },
        ChangeStatus(status) {
            axios
                .put("/cook/order/" + this.meal.id, { status })
                .then((response) => {
                    this.$emit("status-update", response.data.order.status);
                })
                .catch((error) => {
                    console.error("Error sending data:", error);
                });
        },
    },
};
</script>
