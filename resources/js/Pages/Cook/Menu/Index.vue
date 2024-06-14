<script setup>
import { Head, Link } from "@inertiajs/vue3";
import TableHeadVue from "@/Components/Table/TableHead.vue";
import TableRow from "./TableRow.vue";
import HeaderVue from "../Header.vue";
import CaretDown from "@/Components/CaretDown.vue";
import CaretUp from "@/Components/CaretUp.vue";
</script>

<template>
    <Head title="Menu" />
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
                        <div class="py-5 lg:py-8">
                            <h1
                                class="font-semibold text-3xl lg:text-5xl text-oynx dark:text-snow"
                            >
                                Glad you're back,
                                <span class="capitalize">
                                    {{ firstWord }}
                                </span>
                            </h1>
                        </div>
                        <div
                            class="flex flex-col md:flex-row items-start justify-between md:items-center"
                        >
                            <div class="py-3">
                                <h1
                                    v-if="
                                        cook.certificate == null &&
                                        cook.certificate == null
                                    "
                                    class="lg:text-lg text-oynx dark:text-snow"
                                >
                                    Verify your Account
                                    <Link
                                        :href="`/onboarding/verify-your-account`"
                                        class="text-persian underline"
                                        >here</Link
                                    >
                                </h1>
                                <h1
                                    v-if="!account"
                                    class="lg:text-lg text-oynx dark:text-snow"
                                >
                                    Setup your payment account
                                    <Link
                                        :href="`/cook/account`"
                                        class="text-persian underline"
                                        >here</Link
                                    >
                                </h1>
                            </div>
                        </div>
                        <div
                            class="flex py-8 flex-wrap md:flex-row items-start justify-between md:items-center"
                        >
                            <div v-if="account" class="p-2 flex">
                                <Link :href="`/cook/account`">
                                    <button
                                        class="shadow-extra-small rounded-md cursor-pointer w-[175px] h-[50px] text-oynx dark:text-snow font-semibold border-none flex justify-center items-center"
                                    >
                                        <span
                                            class="span-mother flex overflow-hidden"
                                        >
                                            <span>Pay</span>
                                            <span>men</span>
                                            <span>t A</span>
                                            <span>cco</span>
                                            <span>un</span>
                                            <span>
                                                t
                                                <font-awesome-icon icon="eye"
                                            /></span>
                                        </span>
                                        <span class="span-mother2 text-persian">
                                            <span>Pay</span>
                                            <span>men</span>
                                            <span>t A</span>
                                            <span>cco</span>
                                            <span>un</span>
                                            <span>
                                                t
                                                <font-awesome-icon icon="eye"
                                            /></span>
                                        </span></button
                                ></Link>
                            </div>

                          
                            <div
                                v-if="
                                    cook.certificate !== null &&
                                    cook.certificate !== null
                                "
                                class="p-2 flex"
                            >
                                <Link :href="`/onboarding/verify-your-account`">
                                    <button
                                        class="shadow-extra-small rounded-md cursor-pointer w-[250px] h-[50px] text-oynx dark:text-snow font-semibold border-none flex justify-center items-center"
                                    >
                                        <span
                                            class="span-mother flex overflow-hidden"
                                        >
                                            <span>Vie</span>
                                            <span>w Ver</span>
                                            <span>fica</span>
                                            <span> tion S</span>
                                            <span>tatu</span>
                                            <span
                                                >s
                                                <font-awesome-icon icon="eye"
                                            /></span>
                                        </span>
                                        <span class="span-mother2 text-persian">
                                            <span>Vie</span>
                                            <span>w Ver</span>
                                            <span>fica</span>
                                            <span> tion S</span>
                                            <span>tatu</span>
                                            <span
                                                >s
                                                <font-awesome-icon icon="eye"
                                            /></span>
                                        </span></button
                                ></Link>
                            </div>
                        </div>

                        <div
                            class="flex flex-col md:flex-row items-start justify-between md:items-center"
                        >
                            <div class="py-3">
                                <h1
                                    class="font-semibold text-xl lg:text-2xl text-oynx dark:text-snow"
                                >
                                    You have {{ menu.length }} meal(s) in your
                                    menu
                                </h1>
                            </div>
                            <div
                                class="flex flex-wrap md:flex-row items-start justify-between md:items-center"
                            >
                                <div class="p-2 flex">
                                    <Link :href="`/become-a-cook/overview`">
                                        <button
                                            class="shadow-extra-small rounded-md cursor-pointer w-[150px] h-[50px] text-oynx dark:text-snow font-semibold border-none flex justify-center items-center"
                                        >
                                            <span
                                                class="span-mother flex overflow-hidden"
                                            >
                                                <span>Cr</span>
                                                <span>ea</span>
                                                <span>t</span>
                                                <span> e M</span>
                                                <span>ea</span>
                                                <span
                                                    >l
                                                    <font-awesome-icon
                                                        icon="plus"
                                                /></span>
                                            </span>
                                            <span
                                                class="span-mother2 text-persian"
                                            >
                                                <span>Cr</span>
                                                <span>ea</span>
                                                <span>t</span>
                                                <span> e M</span>
                                                <span>ea</span>
                                                <span
                                                    >l
                                                    <font-awesome-icon
                                                        icon="plus"
                                                /></span>
                                            </span></button
                                    ></Link>
                                </div>
                            </div>
                        </div>
                        <div class="sm:-mx-6 lg:-mx-8">
                            <div
                                class="inline-block w-full py-2 sm:px-6 lg:px-8"
                            >
                                <div
                                    class="overflow-x-scroll disable-scrollbars"
                                >
                                    <table
                                        class="w-full px-4 text-left text-sm font-light relative"
                                    >
                                        <thead
                                            class="align-bottom shadow-sm translate-x-0 sticky top-1"
                                        >
                                            <tr>
                                                <TableHeadVue>
                                                    <template #title>
                                                        Title
                                                    </template>
                                                    <template #symbols>
                                                        <CaretUp />
                                                        <CaretDown />
                                                    </template>
                                                </TableHeadVue>
                                                <TableHeadVue>
                                                    <template #title>
                                                        Limit
                                                    </template>
                                                    <template #symbols>
                                                        <CaretUp />
                                                        <CaretDown />
                                                    </template>
                                                </TableHeadVue>
                                                <TableHeadVue>
                                                    <template #title>
                                                        Price
                                                    </template>
                                                    <template #symbols>
                                                        <CaretUp />
                                                        <CaretDown />
                                                    </template>
                                                </TableHeadVue>
                                                <TableHeadVue>
                                                    <template #title>
                                                        Ingredients
                                                    </template>
                                                    <template #symbols>
                                                        <CaretUp />
                                                        <CaretDown />
                                                    </template>
                                                </TableHeadVue>
                                                <TableHeadVue>
                                                    <template #title>
                                                        Quick Order
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                title="Click to edit"
                                                v-if="menu.length > 0"
                                                v-for="meal in menu"
                                                :key="meal.id"
                                                class="animate-fade-in border-b py-4 text-oynx active:text-persian hover:text-polynesian dark:text-snow dark:active:text-persian dark:hover:text-lighred"
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
                                                        class="py-6 italic text-lg text-center text-oynx dark:text-snow max-w-xl mx-auto"
                                                    >
                                                        You have nothing here.
                                                        click
                                                        <Link
                                                            :href="`/become-a-cook`"
                                                            class="font-semibold"
                                                            >here
                                                        </Link>
                                                        to add
                                                    </div>
                                                </td>
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
        menu: Object,
        cook: Object,
        account: Object,
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
