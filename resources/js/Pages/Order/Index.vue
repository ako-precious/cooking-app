<script setup>
import { Head, Link } from "@inertiajs/vue3";
import TableHeadVue from "@/Components/Table/TableHead.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import TableRow from "./TableRow.vue";
import DialogModal from "@/Components/DialogModal.vue";
import CaretDown from "@/Components/CaretDown.vue";
import CaretUp from "@/Components/CaretUp.vue";
</script>

<template>
   
    <AppLayout title="Meal Schedule">
        <div
            class="relative sm:flex sm:justify-center sm:items-center bg-center selection:bg-lighred selection:text-white"
        >
            <div class="container py-6 relative mx-auto text-oynx dark:text-snow">
                <div class=" py-3 ">
                    <div
                        class="sticky flex flex-col min-w-full break-words w-full top-1/100 dark:bg-oynx rounded-2xl bg-clip-border"
                    >
                        <ul
                            class=" overflow-x-scroll disable-scrollbars flex  w-full p-4 mb-0 list-none rounded-xl"
                        >
                            <li class="px-2">
                                <button
                                    @click="
                                        [
                                            chooseStatus(meal_orders),
                                            selectedDiv('meal_orders'),
                                        ]
                                    "
                                    :class="{
                                        'bg-persian text-snow':
                                            selected === 'meal_orders',
                                    }"
                                    class="relative w-28 flex items-center justify-center rounded-lg text-oynx dark:text-snow  cursor-pointer border border-persian"
                                >
                                    <span
                                        class="text-center w-full py-2 text-sm tracking-wider z-20 transition-all duration-300 ease-in-out"
                                        >ALL [{{
                                            meal_orders.length
                                        }}]</span
                                    >
                                </button>
                            </li>
                            <li class="px-2">
                                <button
                                    @click="
                                        [
                                            chooseStatus(pending),
                                            selectedDiv('pending'),
                                        ]
                                    "
                                    :class="{
                                        'bg-persian text-snow':
                                            selected === 'pending',
                                    }"
                                    class="relative w-28 flex items-center justify-center rounded-lg text-oynx dark:text-snow overflow-hidden cursor-pointer border border-persian"
                                >
                                    <span
                                        class="text-center w-full py-2 text-sm tracking-wider z-20 transition-all duration-300 ease-in-out"
                                        >Pending [{{
                                            pending.length
                                        }}]</span
                                    >
                                </button>
                            </li>
                            <li class="px-2">
                                <button
                                    @click="
                                        [
                                            chooseStatus(reject),
                                            selectedDiv('reject'),
                                        ]
                                    "
                                    :class="{
                                        'bg-persian text-snow':
                                            selected === 'reject',
                                    }"
                                    class="relative w-28 flex items-center justify-center rounded-lg text-oynx dark:text-snow overflow-hidden cursor-pointer border border-persian"
                                >
                                    <span
                                        class="text-center w-full py-2 text-sm tracking-wider z-20 transition-all duration-300 ease-in-out"
                                        >Rejected [{{
                                            reject.length
                                        }}]</span
                                    >
                                </button>
                            </li>
                            <li class="px-2">
                                <button
                                    @click="
                                        [
                                            chooseStatus(accept),
                                            selectedDiv('accept'),
                                        ]
                                    "
                                    :class="{
                                        'bg-persian text-snow':
                                            selected === 'accept',
                                    }"
                                    class="relative w-28 flex items-center justify-center rounded-lg text-oynx dark:text-snow overflow-hidden cursor-pointer border border-persian"
                                >
                                    <span
                                        class="text-center w-full py-2 text-sm tracking-wider z-20 transition-all duration-300 ease-in-out"
                                        >Accepted [{{
                                            accept.length
                                        }}]</span
                                    >
                                </button>
                            </li>
                            <li class="px-2">
                                <button
                                    @click="
                                        [
                                            chooseStatus(processed),
                                            selectedDiv('processed'),
                                        ]
                                    "
                                    :class="{
                                        'bg-persian text-snow':
                                            selected === 'processed',
                                    }"
                                    class="relative w-28 flex items-center justify-center rounded-lg text-oynx dark:text-snow overflow-hidden cursor-pointer border border-persian"
                                >
                                    <span
                                        class="text-center w-full py-2 text-sm tracking-wider z-20 transition-all duration-300 ease-in-out"
                                        >Processed [{{
                                            processed.length
                                        }}]</span
                                    >
                                </button>
                            </li>
                            <li class="px-2">
                                <button
                                    @click="
                                        [
                                            chooseStatus(delivered),
                                            selectedDiv('delivered'),
                                        ]
                                    "
                                    :class="{
                                        'bg-persian text-snow':
                                            selected === 'delivered',
                                    }"
                                    class="relative w-28 flex items-center justify-center rounded-lg text-oynx dark:text-snow overflow-hidden cursor-pointer border border-persian"
                                >
                                    <span
                                        class="text-center w-full py-2 text-sm tracking-wider z-20 transition-all duration-300 ease-in-out"
                                        >delivered [{{
                                            delivered.length
                                        }}]</span
                                    >
                                </button>
                            </li>
                            <li class="px-2">
                                <button
                                    @click="
                                        [
                                            chooseStatus(confirmed),
                                            selectedDiv('confirmed'),
                                        ]
                                    "
                                    :class="{
                                        'bg-persian text-snow':
                                            selected === 'confirmed',
                                    }"
                                    class="relative w-28 flex items-center justify-center rounded-lg text-oynx dark:text-snow overflow-hidden cursor-pointer border border-persian"
                                >
                                    <span
                                        class="text-center w-full py-2 text-sm tracking-wider z-20 transition-all duration-300 ease-in-out"
                                        >confirmed [{{
                                            confirmed.length
                                        }}]</span
                                    >
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div
                    class="m-auto flex flex-col justify-center h-full lg:pb-10 w-full py-6 shadow-reverse rounded-lg my-2"
                >
                    <div class="lg:w-full">
                        <div class="flex flex-col w-full">
                            <div class=" ">
                                <div class="inline-block w-full py-2">
                                    <div
                                        class="overflow-x-scroll disable-scrollbars">
                                        <table
                                            class="w-full text-left text-sm font-light relative"
                                        >
                                            <thead
                                                class="align-bottom shadow-sm translate-x-0 sticky top-0 z-10 border-b"
                                            >
                                                <tr>
                                                    <TableHeadVue>
                                                        <template #title>
                                                            Meal Title
                                                        </template>
                                                        <template #symbols>
                                                            <CaretUp />
                                                            <CaretDown />
                                                        </template>
                                                    </TableHeadVue>
                                                    <TableHeadVue>
                                                        <template #title>
                                                            Cook's NAme
                                                        </template>
                                                        <template #symbols>
                                                            <CaretUp />
                                                            <CaretDown />
                                                        </template>
                                                    </TableHeadVue>
                                                    <TableHeadVue>
                                                        <template #title>
                                                            Meal Time
                                                        </template>
                                                        <template #symbols>
                                                            <CaretUp />
                                                            <CaretDown />
                                                        </template>
                                                    </TableHeadVue>
                                                    <TableHeadVue>
                                                        <template #title>
                                                            Meal Delivery Date
                                                        </template>
                                                        <template #symbols>
                                                            <CaretUp />
                                                            <CaretDown />
                                                        </template>
                                                    </TableHeadVue>
                                                    <TableHeadVue>
                                                        <template #title>
                                                            status
                                                        </template>
                                                        <template #symbols>
                                                            <CaretUp />
                                                            <CaretDown />
                                                        </template>
                                                    </TableHeadVue>
                                                    <TableHeadVue>
                                                        <template #title>
                                                        </template>
                                                        <template #symbols>
                                                        </template>
                                                    </TableHeadVue>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr
                                                    v-if="orders.length > 0"
                                                    v-for="meal in orders"
                                                    :key="meal.id"
                                                    class="animate-fade-in border-b py-4"
                                                >
                                                    <TableRow :meal="meal">
                                                    </TableRow>
                                                </tr>
                                                <tr
                                                    v-else
                                                    class="animate-fade-in border-b py-4 mx-auto"
                                                >
                                                    <td colspan="6">
                                                        <div
                                                            class="py-6 italic  text-lg text-center text-oynx dark:text-snow max-w-xl mx-auto"
                                                        >
                                                            You have nothing here. click <Link :href="`/`" class=" font-semibold ">here </Link> to add
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div
            class="modal disable-scrollbars overflow-y-auto overflow-x-hidden fixed top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 z-[100] flex justify-center items-center backdrop-blur-sm w-full h-full"
            v-show="newEventModalVisible"
        >
            <div
                class="relative p-4 w-full max-w-md max-h-full transition-all duration-300 ease-in delay-200"
            >
                <div class="relative shadow-reverse rounded-lg">
                    <button
                        @click="closeModal"
                        type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="popup-modal"
                    >
                        <font-awesome-icon
                            icon="fa-solid fa-close"
                            class="text-lighred text-lg"
                        />
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="" v-if="message">
                        <div
                            class="px-6 py-4 mt-1 bg-persian/20 rounded-lg text-persian"
                        >
                            <span class="font-bold"> {{ message }} </span>
                        </div>
                    </div>
                    <div class="" v-if="error">
                        <div
                            class="px-6 py-4 mt-1 bg-lighred/20 rounded-lg text-lighred"
                        >
                            <span class="font-bold">{{ error }}</span>
                        </div>
                    </div>
                    <form @submit.prevent class="p-4 md:py-8 text-center">
                        
                        <div class="py-4 relative">
                            <TextInput
                                class="my-2 w-full"
                                placeholder="Meal Name"
                            />
                           
                        </div>

                        <div class="py-4 flex justify-between">
                            <TextInput
                                class="w-full"
                                type="date"
                                placeholder=""
                            />
                            <TextInput
                                class="w-[47%]" hidden
                                type="date"
                                placeholder=""
                            />
                        </div>
                        <div class="py-4 flex justify-between">
                            <select
                              
                                title="Meal Time"
                                placeholder="Choose a meal time"
                                class="border-oynx bg-snow text-oynx dark:bg-oynx dark:text-snow bg-gradient-to-br from-[#e3dedf] to-[#ffffff] w-full shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md"
                            >
                                <option
                                    selected
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow"
                                >
                                   
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow"
                                    value="breakfast"
                                >
                                    Breakfast
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow"
                                    value="launch"
                                >
                                    Launch
                                </option>
                                <option
                                    class="bg-snow text-oynx dark:bg-oynx dark:text-snow"
                                    value="dinner"
                                >
                                    Dinner
                                </option>
                            </select>
                        </div>
                        <div
                            class="flex justify-center item-center"
                            v-if="addingMode"
                        >
                            <PrimaryButton @click="addSchedule" class="w-full"
                                >Save</PrimaryButton
                            >
                        </div>

                        <template v-else>
                            <!-- <div class="flex justify-center item-center">
                                <PrimaryButton
                                    class="mr-3"
                                    @click="updateSchedule(newSchedule.id)"
                                    v-if="newEventModalVisible"
                                    >Update
                                </PrimaryButton>
                                <SecondaryButton
                                    @click="deleteSchedule(newSchedule.id)"
                                    class="mr-4"
                                >
                                    Delete
                                </SecondaryButton>
                            </div> -->
                        </template>
                    </form>
                </div>
            </div>
        </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import axios from "axios";

export default {
    props: {
        meal_orders: Object,
        pending: Object,
        reject: Object,
        accept: Object,
        processed: Object,
        ready: Object,
        delivered: Object,
        confirmed: Object,
    },
 
    data() {
        return {
            orders: this.meal_orders,
            selected: "meal_orders",
        };
    },
   
    methods: {
        chooseStatus(status) {
            this.orders = status;
        },
        selectedDiv(status) {
            this.selected = status;
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
    animation: fade-in 0.5s ease-in;
}
</style>
