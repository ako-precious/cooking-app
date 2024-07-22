<script setup>
import { onMounted } from "vue";
import { Head, usePage } from "@inertiajs/vue3";
import DropBarNav from "./Header/DropBarNav.vue";
import FoodCard from "@/Layouts/FoodCard.vue";
import Footer from "@/Layouts/Footer.vue";
import Loader from "@/Layouts/Loader.vue";
import DateRangePicker from "./Header/DateRangePicker.vue";
import Navbar from "./Header/Navbar.vue";
import axios from "axios";
import { subscribeUserToPush } from "/resources/js/bootstrap.js"; // Adjust the path as necessary
import { ref, computed } from "vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    pushSub: Boolean,
});

const notificationPermission = ref(Notification.permission);

const showEnableButton = computed(
    () => notificationPermission.value !== "granted"
);

async function requestNotificationPermission() {
    const permission = await Notification.requestPermission();

    if (permission === "granted") {
        await subscribeUserToPush();
        notificationPermission.value = permission;
    } else {
        alert(
            "You need to enable notifications in your browser settings to receive push notifications."
        );
    }
}
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
    <Head title="Welcome" />
    <!-- component -->
    <div class="  ">
        <div
            v-if="notificationPermission !== 'granted' && pushSub === false"
            class="bg-gray-500 m-auto"
        >
            <p
                @click="requestNotificationPermission"
                class="text-xs pl-10 capitalize cursor-pointer hover:underline py-1"
            >
                enable notification
            </p>
        </div>
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
                        <!-- <div
                            
                            class="bg-transparent capitalize font-bold text-sm mr-4 flex justify-around w-full transition-all duration-300 delay-75 ease-in"
                            name=""
                            id=""
                        >
                            <a class="py-2 px-3 navbar-link" href="">
                                <p>Meal Schedule</p>
                            </a>
                            <a class="py-2 px-3 navbar-link" href="">
                                <p>Special Meal</p>
                            </a>
                            <a class="py-2 px-3 navbar-link" href="">
                                <p>Explore</p>
                            </a>
                        </div> -->
                        <DateRangePicker
                            @filter-meals="filterMeals"
                            class="transition-all duration-300 delay-75 ease-in"
                        ></DateRangePicker>
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
            <!-- <DateRangePicker
                @filter-meals="filterMeals"
                v-if="!isHeaderFixed"
                class="hidden lg:flex transition-all duration-300 delay-75 ease-in animate-fade-in"
            ></DateRangePicker> -->
            <DateRangePicker
                @filter-meals="filterMeals"
                class="lg:hidden transition-all duration-300 delay-75 ease-in animate-fade-in w-full"
            ></DateRangePicker>
        </header>
    </div>
    <div
        class="container p-4 lg:p-10 mx-auto relative grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 sm:items-center min-h-screen selection:bg-red-500 selection:text-white bg-snow dark:bg-oynx"
    >
        <div v-for="meal in meals" :key="meal.id" class="animate-fade-in">
            <FoodCard :meal="meal"></FoodCard>
        </div>
    </div>
    <div
        class="flex justify-center items-center flex-col transition-all duration-250 delay-75 ease-bounce sha"
        v-if="hasMoreData"
    >
        <button @click="loadMoreData" class="button">Show More</button>
    </div>
    <!-- {{ $page.props.auth.user }} -->
    <div
        id="defaultModal"
        tabindex="-1"
        aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden flex justify-center items-center fixed top-0 right-0 left-0 w-full md:inset-0 h-modal md:h-full z-990"
    >
        <div class="relative p-4  w-full m-auto max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div
                    class="flex justify-between items-start p-5 rounded-t border-b dark:border-gray-600"
                >
                    <h3
                        class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white"
                    >
                        Terms of Service
                    </h3>
                    <button
                        type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal"
                    >
                        <svg
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="h-52 overflow-y-auto p-5 space-y-6">
                    <p
                        class="text-sm leading-relaxed text-gray-600 dark:text-gray-400"
                    >
                        Ounjemi is a student-run cooking platform that connects
                        home cooks with customers. Please be aware that meals
                        prepared by our student cooks are typically made in
                        their personal homes, which may not have been inspected
                        by public health officials. However, we ensure that all
                        our cooks hold a valid Food Handling Certificate,
                        demonstrating their understanding of proper food
                        handling and safety practices.
                    </p>
                    <p
                        class="text-sm leading-relaxed text-gray-600 dark:text-gray-400"
                    >
                        While we take steps to ensure the quality and safety of
                        our meals, we want to transparently disclose this
                        information to our customers. Additionally, we encourage
                        customers to rate their meals after each order, helping
                        us maintain high standards and accountability within our
                        community.
                    </p>
                    <p
                        class="text-sm leading-relaxed text-gray-600 dark:text-gray-400"
                    >
                        Please note that our platform is in its early stages,
                        and many of our student cooks share apartments, making
                        it challenging to meet traditional commercial kitchen
                        inspection standards. We appreciate your understanding
                        and support as we grow and evolve.
                    </p>
                    <p
                        class="text-sm leading-relaxed text-gray-600 dark:text-gray-400"
                    >
                        Please note that our platform is in its early stages,
                        and many of our student cooks share apartments, making
                        it challenging to meet traditional commercial kitchen
                        inspection standards. We appreciate your understanding
                        and support as we grow and evolve.
                    </p>
                    <p
                        class="text-sm leading-relaxed text-gray-600 dark:text-gray-400"
                    >
                    We encourage you to read our disclaimer carefully before placing your order with Ounjemi. By proceeding, you confirm your understanding and acceptance of the terms."
                    </p>
                </div>
                <!-- Modal footer -->
                <div
                    class="flex items-center p-5 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600"
                >
                    <button
                        data-modal-toggle="defaultModal"
                        type="button"
                        class="text-white bg-gradient-to-br from-pink-500 to-voilet-500 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 text-center inline-flex items-center shadow-md shadow-gray-300 hover:scale-[1.02] transition-transform"
                    >
                        I accept
                    </button>
                    <button
                        data-modal-toggle="defaultModal"
                        type="button"
                        class="text-gray-600 bg-white hover:bg-gray-100 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                    >
                        Decline
                    </button>
                </div>
            </div>
        </div>
    </div>
    <Footer></Footer>
</template>

<style scoped>
.button {
    --color: #1b998b;
    font-family: inherit;
    display: inline-block;
    width: 8em;
    height: 2.6em;
    line-height: 2.5em;
    margin: 10px;
    position: relative;
    overflow: hidden;
    border: 2px solid var(--color);
    transition: color 0.5s;
    z-index: 1;
    font-size: 17px;
    border-radius: 6px;
    font-weight: 600;
    color: var(--color);
}

.button:before {
    content: "";
    position: absolute;
    z-index: -1;
    background: var(--color);
    height: 150px;
    width: 200px;
    border-radius: 50%;
}

.button:hover {
    color: #fff;
}

.button:before {
    top: 100%;
    left: 100%;
    transition: all 0.7s;
}

.button:hover:before {
    top: -30px;
    left: -30px;
}

.button:active:before {
    background: #0e534b;
    transition: background 0s;
}
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
.fix {
    position: fixed;
    top: 0;
    right: 0;
    width: 100%;
    padding: 0.4rem 2rem;
    z-index: 1000; /* Adjust z-index as needed */
}

@keyframes fade-in {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-in;
}
</style>
