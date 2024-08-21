<script setup>
import { Head, Link } from "@inertiajs/vue3";
import TableHeadVue from "@/Components/Table/TableHead.vue";
import TableRow from "./TableRow.vue";
import HeaderVue from "../Header.vue";
import WelcomeUser from "../WelcomeCook.vue";
import CaretDown from "@/Components/CaretDown.vue";
import CaretUp from "@/Components/CaretUp.vue";
</script>

<template>
    <Head title="Account Onboarding" />
    <div
        class="relative sm:flex sm:justify-center sm:items-center bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-white"
    >
        <div class="container relative mx-auto overflow-hidden">
            <HeaderVue> </HeaderVue>
            <div
                class="m-auto flex flex-col justify-center h-full p-6 lg:pb-20 w-full"
            >
                <div class="lg:w-full">
                    <div class="flex flex-col w-full">
                        <WelcomeUser></WelcomeUser>  
                        <div class="flex justify-between items-center">
                            
                            <div class="p-2 flex">
                                <button
                                    @click="CookAccount"
                                    class="shadow-md rounded-md cursor-pointer w-[250px] h-[50px] text-oynx dark:text-snow font-semibold border-none flex justify-center items-center"
                                >
                                    <span
                                        class="span-mother flex overflow-hidden"
                                    >
                                        <span>Crea</span>
                                        <span>te A S</span>
                                        <span>trip</span>
                                        <span> e Ac</span>
                                        <span>cou</span>
                                        <span
                                            >nt <font-awesome-icon icon="plus"
                                        /></span>
                                    </span>
                                    <span class="span-mother2">
                                        <span>Crea </span>
                                        <span>te A S</span>
                                        <span>trip</span>
                                        <span> e Ac</span>
                                        <span>cou</span>
                                        <span
                                            >nt <font-awesome-icon icon="plus"
                                        /></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="sm:-mx-6 lg:-mx-8">
                            <div
                                class="inline-block min-w-full py-2 sm:px-6 lg:px-8"
                            >
                                <div class="overflow-x-auto">
                                    <table
                                        class="min-w-full text-left text-sm font-light relative"
                                    >
                                        <thead
                                            class="align-bottom shadow-sm translate-x-0 sticky top-1"
                                        >
                                            <tr>
                                                <TableHeadVue>
                                                    <template #title>
                                                        stripe account id
                                                    </template>
                                                    <template #symbols>
                                                        <CaretUp />
                                                        <CaretDown />
                                                    </template>
                                                </TableHeadVue>
                                                <TableHeadVue>
                                                    <template #title>
                                                        charges enabled
                                                    </template>
                                                    <template #symbols>
                                                        <CaretUp />
                                                        <CaretDown />
                                                    </template>
                                                </TableHeadVue>
                                                <TableHeadVue>
                                                    <template #title>
                                                        transfer enabled
                                                    </template>
                                                    <template #symbols>
                                                        <CaretUp />
                                                        <CaretDown />
                                                    </template>
                                                </TableHeadVue>
                                                <TableHeadVue>
                                                    <template #title>
                                                        detailed submitted
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
                                                v-for="account in accounts"
                                                :key="account.id"
                                                class="animate-fade-in border-b py-5"
                                            >
                                                <TableRow
                                                    :account="account"
                                                    
                                                >
                                                </TableRow>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- </div> -->
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
        accounts: Object,
    },
    computed: {
        firstWord() {
            // Check if $page.props.auth.user.name is defined
            if (
                this.$page.props.auth &&
                this.$page.props.auth.user &&
                this.$page.props.auth.user.name
            ) {
                // Split the name string into an array of words
                const words = this.$page.props.auth.user.name.split(" ");

                // Return the first word
                return words[0];
            } else {
                return ""; // Return an empty string if $page.props.auth.user.name is undefined
            }
        },
    },
    methods: {
        CookAccount() {
            // Send an HTTP request to your backend API to save the data

            axios
                .post("/cook/account")
                .then((response) => {
                    window.location.href = response.data.url;
                })
                .catch((error) => {
                    // Handle error
                    console.error("Error saving data:", error);
                });
        },
    },
};
</script>

<style scoped>
button:hover .span-mother {
    position: absolute;
}

button:hover .span-mother span {
    transform: translateY(1.3em);
}

button .span-mother span:nth-child(1) {
    transition: 0.2s;
}

button .span-mother span:nth-child(2) {
    transition: 0.3s;
}

button .span-mother span:nth-child(3) {
    transition: 0.4s;
}

button .span-mother span:nth-child(4) {
    transition: 0.5s;
}

button .span-mother span:nth-child(5) {
    transition: 0.6s;
}

button .span-mother span:nth-child(6) {
    transition: 0.7s;
}
button .span-mother2 {
    display: flex;
    position: absolute;
    overflow: hidden;
}

button .span-mother2 span {
    transform: translateY(-1.5em);
}

button:hover .span-mother2 span {
    transform: translateY(0);
}

button .span-mother2 span {
    transition: 0.2s;
}

button .span-mother2 span:nth-child(2) {
    transition: 0.3s;
}

button .span-mother2 span:nth-child(3) {
    transition: 0.4s;
}

button .span-mother2 span:nth-child(4) {
    transition: 0.5s;
}

button .span-mother2 span:nth-child(5) {
    transition: 0.6s;
}

button .span-mother2 span:nth-child(6) {
    transition: 0.7s;
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
