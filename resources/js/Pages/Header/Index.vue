<script setup>
import { onMounted } from "vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import DropBarNav from "./DropBarNav.vue";
import DateRangePicker from "./DateRangePicker.vue";
import Navbar from "./Navbar.vue";
import axios from "axios";
import { subscribeUserToPush } from "/resources/js/bootstrap.js"; // Adjust the path as necessary
import { route } from 'ziggy-js';


defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    pushSub: Boolean,
});

// const notificationPermission = ref(Notification.permission);

// const showEnableButton = computed(
//     () => notificationPermission.value !== "granted"
// );

// async function requestNotificationPermission() {
//     const permission = await Notification.requestPermission();

//     if (permission === "granted") {
//         await subscribeUserToPush();
//         notificationPermission.value = permission;
//     } else {
//         alert(
//             "You need to enable notifications in your browser settings to receive push notifications."
//         );
//     }
// }
</script>

<script>
export default {
    inheritAttrs: false,

    data() {
        return {
            meals: [],
            page: 1, // Current page
            perPage: 12, // Number of items per page
            hasMoreData: true,
            isHeaderFixed: false,
        };
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.handleScroll);
    },

    mounted() {
        window.addEventListener("scroll", this.handleScroll);
        if (this.$page.props.auth.user) {
            if (
                this.$page.props.auth.user.phone_number == null ||
                this.$page.props.auth.user.address == null
            ) {
                this.$inertia.visit(`/user/profile`);
            }
        }
    },
    created() {
        this.handleScroll();
        this.fetchData();
    },
    methods: {
        async filterMeals(searchText) {
            await axios
                .get(`/api/filtered-meals?query=${searchText}`)
                .then((response) => {
                    if (response.data.length != 0) {
                        this.meals = response.data;
                    }
                })
                .catch((error) => {
                    console.error("Error fetching filtered data:", error);
                });
        },
        async loadMoreData() {
            if (this.hasMoreData) {
                this.page++;
                await this.fetchData();
            }
        },
        async fetchData() {
            try {
                const response = await axios.get(
                    `/api/meals?page=${this.page}&perPage=${this.perPage}`
                );
                const newMeals = response.data;

                // If there is no new data, set hasMoreData to false
                if (newMeals.length === 0) {
                    this.hasMoreData = false;
                }

                // Concatenate new data to the existing meals
                this.meals = [...this.meals, ...newMeals];
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        },
        handleScroll() {
            // Adjust the scroll threshold as needed
            const scrollThreshold = 20;
            this.isHeaderFixed = window.scrollY > scrollThreshold;
        },
    },
};
</script>


<template>
     <div class="  ">
        <!-- <div
            v-if="notificationPermission !== 'granted' && pushSub === false"
            class="bg-gray-500 m-auto"
        >
            <p
                @click="requestNotificationPermission"
                class="text-xs pl-10 capitalize cursor-pointer hover:underline py-1"
            >
                enable notification
            </p>
        </div> -->
        <header
            :class="{
                'fix align-bottom shadow-sm py-4 px-8 lg ': isHeaderFixed,
            }"
            class="py-5 bg-snow dark:bg-oynx z-990 transition-all duration-300 delay-75 ease-in animate-fade-in"
        >
            <Navbar class="bg-snow dark:bg-oynx">
                <template #search>
                    <div
                        class="w-full p-4 max-w-xs lg:max-w-lg 2xl:max-w-2xl bg-snow dark:bg-oynx rounded-md hidden lg:flex items-center"
                    >
                        <div
                            v-if="!isHeaderFixed"
                            class="bg-transparent capitalize font-bold text-sm mr-4 flex justify-around w-full transition-all duration-300 delay-75 ease-in"
                            name=""
                            id=""
                        >
                            <Link
                                class="py-2 px-3 navbar-link"
                                :href="route('welcome')"
                            >
                                <p>Explore</p>
                            </Link>
                            <Link
                                class="py-2 px-3 navbar-link"
                                :href="route('bulk-meal')"
                            >
                                <p>Bulk Meal</p>
                            </Link>
                            <Link
                                class="py-2 px-3 navbar-link"
                                :href="route('special-order')"
                            >
                                <p>Special Order</p>
                            </Link>
                        </div>
                        <slot  name="search-content"></slot>
                        <!-- <DateRangePicker
                            @filter-meals="filterMeals"
                            v-if="isHeaderFixed"
                            class="transition-all duration-300 delay-75 ease-in"
                        ></DateRangePicker> -->
                    </div>
                </template>
                <template #dropdown>
                    <DropBarNav
                        :canLogin="canLogin"
                        :canRegister="canRegister"
                        :laravelVersion="laravelVersion"
                        :phpVersion="phpVersion"
                    />
                </template>
            </Navbar>
            <!-- @filter-meals="emits('filterMeals')" -->
             <slot  name="extra-content"></slot>
            <!-- <DateRangePicker
                v-if="!isHeaderFixed"
                @filter-meals="filterMeals"
                class="hidden lg:flex transition-all duration-300 delay-75 ease-in animate-fade-in"
            ></DateRangePicker>
            <DateRangePicker
                @filter-meals="filterMeals"
                class="lg:hidden transition-all duration-300 delay-75 ease-in animate-fade-in w-full"
            ></DateRangePicker> -->
        </header>
    </div>
</template>

<style scoped>
.fix {
    position: fixed;
    top: 0;
    right: 0;
    width: 100%;
    padding: 0.4rem 2rem;
    z-index: 1000; /* Adjust z-index as needed */
}

</style>