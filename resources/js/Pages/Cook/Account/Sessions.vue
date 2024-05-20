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

                        <div class="sm:-mx-6 lg:-mx-8">
                            <div
                                class="inline-block min-w-full py-2 sm:px-6 lg:px-8"
                            >
                                <div class="">
                                    <div id="container">
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
        return { hasError: false };
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
                const container = document.getElementById("container");
                const paymentsComponent = instance.create("payments");
                container.appendChild(paymentsComponent);
            }
        };

        initializeStripe();
    },
};
</script>
