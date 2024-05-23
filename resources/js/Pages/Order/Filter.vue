<script setup>
import { useForm } from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

// const props = defineProps({ filters: Object });
// const emit = defineEmits(['filter-update']);

// const filterForm = useForm({
//     name: props.filters.name ?? null,
//     status: props.filters.status ?? null,
//     meal_time: props.filters.meal_time ?? null,
//     delivery_date_from: props.filters.delivery_date_from ?? null,
//     delivery_date_to: props.filters.delivery_date_to ?? null,
// });

// const filter = async () => {
//     try {
//         const response = await filterForm.get('/meal-schedule', {
//             preserveScroll: true,
//             preserveState: true,
//             replace: true,
//         });
//         // console.log(response);
//         emit('filter-update', response);
//     } catch (error) {
//         console.error('Error fetching filtered data:', error);
//     }
// };

// const clear = () => {
//     filterForm.name = null;
//     filterForm.status = null;
//     filterForm.meal_time = null;
//     filterForm.delivery_date_from = null;
//     filterForm.delivery_date_to = null;
//     filter();
// };
</script>
<template>
    <form @submit.prevent="filter">
        <div class="mb-8 mt-4 flex flex-col gap-2 justify-center m-auto">
            <div>
                <h2 class="text-oynx dark:text-snow text-xl md:text-2xl">
                    Filter Page
                </h2>
            </div>
            <div class="flex flex-col mt-4 group">
                <InputLabel class="text-lg" for="email" value="Meal Name" />
                <TextInput
                    id="meal"
                    v-model="filterForm.name"
                    type="text"
                    class="mt-1 block w-full p-3"
                    autofocus
                    autocomplete="Meal name"
                />
            </div>
            <div class="flex flex-nowrap py-4 items-center">
                <div class="flex flex-col rounded-lg mr-1 w-1/2">
                    <InputLabel
                        class="text-lg"
                        for="status"
                        value="Meal Status"
                    />
                    <select
                        v-model="filterForm.status"
                        title="Status"
                        class="p-3 border-oynx bg-snow text-oynx dark:bg-oynx dark:text-snow bg-gradient-to-br from-[#e3dedf] to-[#ffffff] w-full shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md"
                    >
                        <option
                            class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2"
                            :value="null"
                        ></option>
                        <option
                            class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2"
                            value="pending"
                        >
                            Pending
                        </option>
                        <option
                            class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2"
                            value="rejected"
                        >
                            Rejected
                        </option>
                        <option
                            class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2"
                            value="accepted"
                        >
                            Accepted
                        </option>
                        <option
                            class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2"
                            value="processed"
                        >
                            Processed
                        </option>
                        <option
                            class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2"
                            value="ready"
                        >
                            Ready
                        </option>
                        <option
                            class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2"
                            value="in transit"
                        >
                            In Transit
                        </option>
                        <option
                            class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2"
                            value="delivered"
                        >
                            Delivered
                        </option>
                        <option
                            class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2"
                            value="confirmed"
                        >
                            Confirmed
                        </option>
                    </select>
                </div>
                <div class="flex flex-col ml-1 rounded-lg w-1/2">
                    <InputLabel class="text-lg" for="time" value="Meal Time" />
                    <select
                        v-model="filterForm.meal_time"
                        title="Meal Time"
                        placeholder="Choose a meal time"
                        class="p-3 border-oynx bg-snow text-oynx dark:bg-oynx dark:text-snow bg-gradient-to-br from-[#e3dedf] to-[#ffffff] w-full shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md"
                    >
                        <option
                            class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2"
                            :value="null"
                        ></option>
                        <option
                            class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2"
                            value="breakfast"
                        >
                            Breakfast
                        </option>
                        <option
                            class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2"
                            value="lunch"
                        >
                            Lunch
                        </option>
                        <option
                            class="bg-snow dark:bg-oynx text-oynx dark:text-snow p-2"
                            value="dinner"
                        >
                            Dinner
                        </option>
                    </select>
                </div>
            </div>
            <div><h4 class="text-oynx dark:text-snow">Delivery Date</h4></div>
            <div class="flex flex-nowrap items-center">
                <div class="flex flex-col rounded-lg mr-1 w-1/2">
                    <InputLabel class="text-lg" for="email" value="From" />
                    <TextInput
                        id="meal"
                        v-model="filterForm.delivery_date_from"
                        type="date"
                        class="mt-1 block w-full p-3"
                        placeholder=""
                    />
                </div>
                <div class="flex flex-col ml-1 rounded-lg w-1/2">
                    <InputLabel class="text-lg" for="email" value="To" />
                    <TextInput
                        v-model="filterForm.delivery_date_to"
                        id="meal"
                        type="date"
                        class="mt-1 block w-full p-3"
                    />
                </div>
            </div>
            <div class="flex justify-between px-3">
                <PrimaryButton class="w-28" type="submit">Filter</PrimaryButton>
                <button type="reset" class="relative group" @click="clear">
                    <span
                        class="hover-underline-animation ml-5 text-lg capitalize"
                        >clear</span
                    >
                </button>
            </div>
        </div>
    </form>
</template>

<script>
import axios from "axios";
export default {
    props: {
        filters: {
            type: Object,
            required: true,
        },
    },
    emits: ["filter-update"],
    data() {
        return {
            filterForm: {
                name: this.filters.name ?? null,
                status: this.filters.status ?? null,
                meal_time: this.filters.meal_time ?? null,
                delivery_date_from: this.filters.delivery_date_from ?? null,
                delivery_date_to: this.filters.delivery_date_to ?? null,
            },
        };
    },
    methods: {
        async filter() {
            try {
                axios
                    .get("/filter", this.newRating)
                    .then((resp) => {
                        console.log(resp);
                        this.$emit("filter-update", resp);
                        // setTimeout(() => {
                        //     this.closeModal();
                        //     // Uncomment the line below if you want to toggle addingMode after the delay
                        //     // this.addingMode = !this.addingMode;
                        // }, 5000);
                    })
                    .catch((err) => {
                        console.log(err);
                        // this.error = "Unable to add Meal !";
                        // setTimeout(() => {
                        //     this.error = "";
                        // }, 10000);
                    });
                // const response = await this.filterFormget('/meal-schedule', {
                //   preserveScroll: true,
                //   preserveState: true,
                //   replace: true,
                // });
            } catch (error) {
                console.error("Error fetching filtered data:", error);
            }
        },
        clear() {
            this.filterForm.name = null;
            this.filterForm.status = null;
            this.filterForm.meal_time = null;
            this.filterForm.delivery_date_from = null;
            this.filterForm.delivery_date_to = null;
            this.filter();
        },
    },
};
</script>
<style scoped>
button:after {
    content: " ";
    width: 0%;
    height: 100%;
    /* background: #1b998b; */
    position: absolute;
    transition: all 0.4s ease-in-out;
    right: 0;
}

button:hover::after {
    right: auto;
    left: 0;
    width: 100%;
}

button:hover span {
    color: white;
    animation: scaleUp 0.3s ease-in-out;
}

@keyframes scaleUp {
    0% {
        transform: scale(1);
    }

    50% {
        transform: scale(0.95);
    }

    100% {
        transform: scale(1);
    }
}

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
    animation: fade-in 0.5s ease-in;
}
</style>
