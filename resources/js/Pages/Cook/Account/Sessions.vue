<script setup>
import axios from "axios";
import { loadConnectAndInitialize } from "@stripe/connect-js";
import { Head } from "@inertiajs/vue3";

import HeaderVue from "../Header.vue";
</script>
<template>
    <Head title="Account Dashboard" />
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
                                    <!-- {{ firstWord($page.props.auth.user.name ) }} -->
                                </span>
                            </h1>
                        </div>
                        <div class="col-span-1 w-full max-w-full py-6">
                            <div
                                class="sticky flex flex-col min-w-full break-words w-full top-1/100 dark:bg-oynx rounded-2xl bg-clip-border"
                            >
                                <ul
                                    class="overflow-x-scroll disable-scrollbars flex  w-full p-8 mb-0 list-none rounded-xl"
                                >
                                    <li class="px-2">
                                        <button
                                            @click="selectedDiv('payment')"
                                            :class="{
                                                'bg-persian text-snow':
                                                    selected === 'payment',
                                            }"
                                            class="relative w-32 font-bold flex items-center justify-center rounded-lg text-oynx dark:text-snow overflow-hidden cursor-pointer border border-persian"
                                        >
                                            <span
                                                class="text-center w-full py-2 text-sm tracking-wider capitalize z-20 transition-all duration-300 ease-in-out"
                                                >Payments</span
                                            >
                                        </button>
                                    </li>
                                    <li class="px-2">
                                        <button
                                            @click="selectedDiv('balance')"
                                            :class="{
                                                'bg-persian text-snow':
                                                    selected === 'balance',
                                            }"
                                            class="relative w-32 font-bold flex items-center justify-center rounded-lg text-oynx dark:text-snow overflow-hidden cursor-pointer border border-persian"
                                        >
                                            <span
                                                class="text-center w-full py-2 text-sm tracking-wider capitalize z-20 transition-all duration-300 ease-in-out"
                                                >Balances</span
                                            >
                                        </button>
                                    </li>
                                    <li class="px-2">
                                        <button
                                            @click="selectedDiv('management')"
                                            :class="{
                                                'bg-persian text-snow':
                                                    selected === 'management',
                                            }"
                                            class="relative w-50 font-bold flex items-center justify-center rounded-lg text-oynx dark:text-snow overflow-hidden cursor-pointer border border-persian"
                                        >
                                            <span
                                                class="text-center w-full py-2 text-sm tracking-wider capitalize z-20 transition-all duration-300 ease-in-out"
                                                >Account Management</span
                                            >
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="sm:mx-6 lg:mx-8">
                            <div
                                class="inline-block min-w-full overflow-x-scroll disable-scrollbars shadow-reverse py-8 sm:px-6 lg:px-8"
                            >
                                <div class="">
                                    <div
                                        :class="{
                                            hidden: selected !== 'payment',
                                        }"
                                        id="payment"
                                    >
                                        <div v-if="hasError">
                                            Something went wrong!
                                        </div>
                                    </div>
                                    <div
                                        :class="{
                                            hidden: selected !== 'balance',
                                        }"
                                        id="contained"
                                    >
                                        <div v-if="hasError">
                                            Something went wrong!
                                        </div>
                                    </div>
                                    <div
                                        :class="{
                                            hidden: selected !== 'management',
                                        }"
                                        id="management"
                                    >
                                        <div v-if="hasError">
                                            Something went wrong!
                                        </div>
                                    </div>
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
export default {
    props: {
        account: String,
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
    data() {
        return { selected: "payment", hasError: false };
    },
    mounted() {
        const fetchClientSecret = async () => {
            try {
                const response = await axios.post(
                    `/dashboard-link/${this.account}`
                );
                const clientSecret = response.data.client_secret;

                if (typeof clientSecret !== "string") {
                    throw new Error("Invalid client secret type");
                }

                return clientSecret;
            } catch (error) {
                console.error("An error occurred: ", error);
                this.hasError = true;
                return undefined;
            }
        };

        const initializeStripe = async () => {
            const clientSecret = await fetchClientSecret();
            if (clientSecret) {
                const instance = await loadConnectAndInitialize({
                    publishableKey:
                        "pk_test_51OjplDL2JFKeogL4wsxVYfkG8zCegW66jPKapqF6QtnmakopSVRHFn2YE4tuQK4ZhZROFhJ9iTohD5dZ2wlS1H9x00zqkwyGg2",
                    fetchClientSecret: async () => clientSecret,
                    appearance: {
                        overlays: "dialog",

                        variables: {
                            buttonPrimaryColorBackground: "#1B998B",
                            buttonPrimaryColorText: "#FCF7F8",
                            colorText: "#8392AB",
                            colorSecondaryText: "#8392AB",
                            headingLgFontSize: "50px",
                        },
                    },
                });
                const paymentsComponent = instance.create("payments");
                const balancesComponent = instance.create("balances");
                const accountManagement = instance.create("account-management");
                management.appendChild(accountManagement);

                payment.appendChild(paymentsComponent);
                contained.appendChild(balancesComponent);
            }
        };

        initializeStripe();
    },
    methods: {
      
        selectedDiv(status) {
            this.selected = status;
        },
       
    },
};
</script>
<style scoped>
button:after {
    content: " ";
    width: 0%;
    height: 100%;
    background: #1b998b;
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