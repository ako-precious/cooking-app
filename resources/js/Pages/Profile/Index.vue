<script setup>
import { Head, Link } from "@inertiajs/vue3";
import axios from "axios";
import Card from "./Card.vue";

import Navbar from "../Header/Navbar.vue";
import DropBarNav from "../Header/DropBarNav.vue";
import Footer from "@/Layouts/Footer.vue";
import OtherInfo from "./Partials/OtherInfo.vue";
</script>
<template>
    <Head title="Cook's Profile" />

    <header
            :class="{
                'fix align-bottom shadow-sm py-4 px-8 lg ': isHeaderFixed,
            }"
            class="py-5 bg-snow dark:bg-oynx z-990 transition-all duration-300 delay-75 ease-in animate-fade-in"
        >
            <Navbar class="bg-snow dark:bg-oynx">                
                <template #dropdown>
                    <DropBarNav />
                </template>
            </Navbar>
           
        </header>

    <section class="pt-16 bg-snow dark:bg-oynx">
        <div class="lg:w-4/5 px-4 mx-auto">
            <div
                class="relative flex flex-col min-w-0 break-words shadow-reverse w-full mb-6 rounded-lg mt-16"
            >
                <div class="px-6">
                    <div class="flex flex-wrap justify-center">
                        <div
                            class="w-full px-4 flex lg:hidden justify-center lg:justify-between gap-4"
                        >
                            <div class="">
                                <div class="relative w-full">
                                    <img
                                        v-if="user.profile_photo_path"
                                        :src="
                                            getProfilePhotoUrl(
                                                user.profile_photo_path
                                            )
                                        "
                                        class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px"
                                        alt="avatar"
                                    />
                                    <img
                                        v-else
                                        :src="`https://ui-avatars.com/api/?name=${user.name}&color=FE6D73&background=004E98`"
                                        class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px"
                                        alt="avatar"
                                    />
                                </div>
                            </div>
                        </div>
                        <div
                            class="w-full hidden px-4 lg:flex justify-between gap-4"
                        >
                            <div class="lg:flex py-4 lg:pt-4 lg:w-4/12">
                                <div class="p-3 text-center">
                                    <span
                                        class="text-xl font-bold block uppercase tracking-wide text-oynx dark:text-snow"
                                    >
                                        {{ timeCooking }}
                                    </span>
                                    <span
                                        class="text-xs text-oynx dark:text-snow"
                                    >
                                        {{ CookingDate }} Cooking</span
                                    >
                                </div>
                                <div class="p-3 text-center">
                                    <span
                                        class="text-xl font-bold block uppercase tracking-wide text-oynx dark:text-snow"
                                    >
                                        {{ ratings }}
                                    </span>
                                    <span
                                        class="text-xs text-oynx dark:text-snow"
                                        >Rating</span
                                    >
                                </div>
                                <div class="p-3 text-center">
                                    <span
                                        class="text-xl font-bold block uppercase tracking-wide text-oynx dark:text-snow"
                                    >
                                        {{ reviews.length }}
                                    </span>
                                    <span
                                        class="text-xs text-oynx dark:text-snow"
                                        >Review(s)</span
                                    >
                                </div>
                            </div>
                            <div class="">
                                <div class="relative w-full">
                                    <img
                                        v-if="user.profile_photo_path"
                                        :src="
                                            getProfilePhotoUrl(
                                                user.profile_photo_path
                                            )
                                        "
                                        class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px"
                                        alt="avatar"
                                    />
                                    <img
                                        v-else
                                        :src="`https://ui-avatars.com/api/?name=${user.name}&color=FE6D73&background=004E98`"
                                        class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px"
                                        alt="avatar"
                                    />
                                    <!-- <img alt="..." src="https://demos.creative-tim.com/notus-js/assets/img/team-2-800x800.jpg" class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px"> -->
                                </div>
                            </div>
                            <div
                                class="hidden lg:block text-center lg:w-4/12 mt-6"
                            >
                                <h3
                                    class="text-xl font-semibold leading-normal mb-2 text-oynx dark:text-snow capitalize"
                                >
                                    {{ user.name }}
                                </h3>
                                <div
                                    class="text-sm leading-normal mt-0 mb-2 text-oynx dark:text-snow font-bold uppercase"
                                >
                                    <i
                                        class="fas fa-map-marker-alt mr-2 text-lg text-oynx dark:text-snow"
                                    ></i>
                                    {{ extractCityAndCountry(user.address) }}
                                </div>
                            </div>
                        </div>
                        <div
                            class="block lg:hidden w-full px-4 text-center mt-20"
                        >
                            <div class="flex justify-center py-4 lg:pt-4 pt-8">
                                <div class="p-3 text-center">
                                    <span
                                        class="text-xl font-bold block uppercase tracking-wide text-oynx dark:text-snow"
                                    >
                                        {{ timeCooking }}
                                    </span>
                                    <span
                                        class="text-xs text-oynx dark:text-snow"
                                    >
                                        {{ CookingDate }} Cooking</span
                                    >
                                </div>
                                <div class="p-3 text-center">
                                    <span
                                        class="text-xl font-bold block uppercase tracking-wide text-oynx dark:text-snow"
                                    >
                                        {{ ratings.toFixed(1) }}
                                    </span>
                                    <span
                                        class="text-xs text-oynx dark:text-snow"
                                        >Rating</span
                                    >
                                </div>
                                <div class="p-3 text-center">
                                    <span
                                        class="text-xl font-bold block uppercase tracking-wide text-oynx dark:text-snow"
                                    >
                                        {{ reviews.length }}
                                    </span>
                                    <span
                                        class="text-xs text-oynx dark:text-snow"
                                        >Review(s)</span
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block lg:hidden text-center mt-6">
                        <h3
                            class="text-xl font-semibold leading-normal mb-2 text-oynx dark:text-snow capitalize"
                        >
                            {{ user.name }}
                        </h3>
                        <div
                            class="text-sm leading-normal mt-0 mb-2 text-oynx dark:text-snow font-bold uppercase"
                        >
                            <i
                                class="fas fa-map-marker-alt mr-2 text-lg text-oynx dark:text-snow"
                            ></i>
                            {{ user.address }}
                        </div>
                    </div>
                    <div
                        class="mt-10 py-10 border-t border-gray-500 text-center"
                    >
                        <div class="flex flex-wrap justify-center">
                            <div
                                v-if="cook.other_info == null"
                                class="text-left w-full px-4"
                            >
                                <p
                                    class="mb-4 text-lg leading-relaxed text-oynx dark:text-snow"
                                >
                                    {{ user.other_info }}
                                </p>
                                <div>
                                    <p
                                        class="mt-4 text-sm leading-relaxed text-oynx dark:text-snow"
                                    >
                                        Click
                                        <span class="font-bold cursor-pointer"
                                            >here</span
                                        >
                                        answer questions that makes the your
                                        customer know you more
                                    </p>
                                </div>
                            </div>
                            <div v-else class="w-full px-4">
                                <p
                                    class="mb-4 text-lg leading-relaxed text-oynx dark:text-snow"
                                >
                                    {{ cook.other_info }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="py-10 border-t border-gray-500 text-center mx-auto relative grid s md:grid-cols-3 sm:grid-cols-2 gap-8"
                    >
                        <div
                            v-for="meal in meals"
                            :key="meal.id"
                            class="animate-fade-in"
                        >
                            <Card :meal="meal"></Card>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <div    class="modal disable-scrollbars pt-12 fixed top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 z-[100] flex justify-center items-center backdrop-blur-sm w-full h-full"
    > <div
            class="relative p-4 w-full  max-h-[90%]  disable-scrollbars overflow-y-auto overflow-x-hidden transition-all duration-300 ease-in delay-200"
        >
        
        <OtherInfo></OtherInfo>
    </div>
    </div>
    <Footer></Footer>
</template>

<script>
export default {
    inheritAttrs: false,
    props: {
        user: Object,
        cook: Object,
        reviews: Object,
        ratings: String,
        rating: Object,
        meals: Object, // Prop to receive paginated notifications data from Inertia
    },
    data() {
        return {
            src: "",
            isLoading: true,
        };
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.handleScroll);
    },

    mounted() {
        // window.addEventListener("scroll", this.handleScroll);
        this.extractCityAndCountry();
        window.addEventListener("scroll", this.handleScroll);
    },
    created() {
        this.handleScroll();
        // this.fetchData();
    },
    computed: {
        timeCooking() {
            const createdAt = new Date(this.user.created_at);
            const now = new Date();
            const diffTime = Math.abs(now - createdAt);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            if (diffDays < 30) {
                return `${diffDays} `;
            } else if (diffDays < 365) {
                const diffMonths = Math.floor(diffDays / 30);
                return `${diffMonths} `;
            } else {
                const diffYears = Math.floor(diffDays / 365);
                return `${diffYears}`;
            }
        },
        CookingDate() {
            const createdAt = new Date(this.user.created_at);
            const now = new Date();
            const diffTime = Math.abs(now - createdAt);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            if (diffDays < 30) {
                return `Days`;
            } else if (diffDays < 365) {
                return `Months`;
            } else {
                return `Years`;
            }
        },
        
    },
    methods: {
        getProfilePhotoUrl(profilePhotoPath) {
            if (
                profilePhotoPath.includes("https://lh3.googleusercontent.com")
            ) {
                return profilePhotoPath;
            } else {
                return `/storage/${profilePhotoPath}`;
            }
        },
        extractCityAndCountry(address) {
            if (!address) return { cityAndState: "", country: "" };
            const parts = address.split(", ");
            const cityAndState =
                parts[parts.length - 3] +
                ", " +
                parts[parts.length - 2] +
                ", " +
                parts[parts.length - 1];
            return cityAndState;
        },
        handleScroll() {
            // Adjust the scroll threshold as needed
            const scrollThreshold = 20;
            this.isHeaderFixed = window.scrollY > scrollThreshold;
        },
    },
};
</script>
