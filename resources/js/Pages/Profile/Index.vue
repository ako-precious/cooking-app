<script setup>
import { Head, Link } from "@inertiajs/vue3";
import axios from "axios";
import Card from "./Card.vue"
</script>
<template>
    <Head title="Cook's Profile" />

    <!-- component -->
    <link
        rel="stylesheet"
        href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css"
    />
    <link
        rel="stylesheet"
        href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css"
    />

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
                                        222
                                    </span>
                                    <span
                                        class="text-sm text-oynx dark:text-snow"
                                        >Days Cooking</span
                                    >
                                </div>
                                <div class="p-3 text-center">
                                    <span
                                        class="text-xl font-bold block uppercase tracking-wide text-oynx dark:text-snow"
                                    >
                                        4.5
                                    </span>
                                    <span
                                        class="text-sm text-oynx dark:text-snow"
                                        >Rating</span
                                    >
                                </div>
                                <div class="p-3 text-center">
                                    <span
                                        class="text-xl font-bold block uppercase tracking-wide text-oynx dark:text-snow"
                                    >
                                        89
                                    </span>
                                    <span
                                        class="text-sm text-oynx dark:text-snow"
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
                                    {{ user.address }}
                                </div>
                            </div>
                        </div>
                        <div
                            class="block lg:hidden w-full px-4 text-center mt-20"
                        >
                            <div class="flex justify-center py-4 lg:pt-4 pt-8">
                                <div class="mr-4 p-3 text-center">
                                    <span
                                        class="text-xl font-bold block uppercase tracking-wide text-oynx dark:text-snow"
                                    >
                                        22
                                    </span>
                                    <span
                                        class="text-sm text-oynx dark:text-snow"
                                        >Months Cooking</span
                                    >
                                </div>
                                <div class="mr-4 p-3 text-center">
                                    <span
                                        class="text-xl font-bold block uppercase tracking-wide text-oynx dark:text-snow"
                                    >
                                        4.5
                                    </span>
                                    <span
                                        class="text-sm text-oynx dark:text-snow"
                                        >Rating</span
                                    >
                                </div>
                                <div class="lg:mr-4 p-3 text-center">
                                    <span
                                        class="text-xl font-bold block uppercase tracking-wide text-oynx dark:text-snow"
                                    >
                                        89
                                    </span>
                                    <span
                                        class="text-sm text-oynx dark:text-snow"
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
                            <div class="w-full lg:w-9/12 px-4">
                                <p
                                    class="mb-4 text-lg leading-relaxed text-oynx dark:text-snow"
                                >
                                    {{ user.other_info }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="py-10 border-t border-gray-500 text-center">
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full lg:w-9/12 px-4">
                                <p
                                    class="mb-4 text-lg leading-relaxed text-oynx dark:text-snow"
                                >
                                    {{ user.other_info }}
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
                          <Card :meal="meal" ></Card>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    inheritAttrs: false,
    props: {
        user: Object,
        meals: Object, // Prop to receive paginated notifications data from Inertia
    },
    data() {
        return {
            src: "",
            isLoading: true,
        };
    },
    beforeDestroy() {
        // window.removeEventListener("scroll", this.handleScroll);
    },

    mounted() {
        // window.addEventListener("scroll", this.handleScroll);
        console.log(this.meals);
    },
    created() {
        // this.handleScroll();
        // this.getPhoto();
        // // this.getNotification();
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
    },
};
</script>
