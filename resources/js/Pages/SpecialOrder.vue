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
import { route } from "ziggy-js";

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
    <Head title="Welcome" />
    <!-- component -->
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
                            <a class="py-2 px-3 navbar-link" href="">
                                <p>Explore</p>
                            </a>
                            <a class="py-2 px-3 navbar-link" href="">
                                <p>Bulk Meal</p>
                            </a>
                            <a class="py-2 px-3 navbar-link" href="">
                                <p>Special Order</p>
                            </a>
                        </div>
                        <DateRangePicker
                            @filter-meals="filterMeals"
                            v-if="isHeaderFixed"
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
            <DateRangePicker
                @filter-meals="filterMeals"
                v-if="!isHeaderFixed"
                class="hidden lg:flex transition-all duration-300 delay-75 ease-in animate-fade-in"
            ></DateRangePicker>
            <DateRangePicker
                @filter-meals="filterMeals"
                class="lg:hidden transition-all duration-300 delay-75 ease-in animate-fade-in w-full"
            ></DateRangePicker>
        </header>
    </div>
    <div
        class="container p-4 lg:p-10 mx-auto relative flex justify-center gap-8 items-center min-h-screen selection:bg-red-500 selection:text-white bg-snow dark:bg-oynx"
    >
        <div class="card md:w-[600px] relative flex justify-center items-center w-[420px] p-[2px] rounded-[22px] overflow-hidden leading-6 transition-all duration-[4800] ease-in-out group">
            <div class="flex flex-col justify-center items-center gap-[24px] p-[20px] rounded-[22px] bg-snow dark:bg-oynx text-snow dark:group-hover:text-snow group-hover:text-oynx  overflow-hidden transition-all duration-480 ease-in-out">
                <p class=" font-bold text-4xl leading-tight z-10 transition-all duration-480 ease-in-out">Unlock Special Orders       </p>
                <p class="z-index-1 opacity-80 text-lg transition-all duration-480 ease-in-out">
                   <span class="text-base"> To access special orders, please complete a minimum of 5
                    orders from our talented cooks. This helps us understand
                    your preferences and serve you better.</span><br>
                    <b> Browse Our Cooks &
                    Start Ordering!</b>
                    <span class="text-base">
<br>
                        -  Explore our platform to discover new cooks <br>
                        - Try their delicious dishes and earn loyalty points <br> -
                        Unlock special orders and tailor meals to your taste
                    </span>
                </p>

                

                  <Link :href="route('welcome') " class="button items-center flex ">View Meals</Link>  
                
            </div>
        </div>
        <!-- Special Order
        <div v-for="meal in meals" :key="meal.id" class="animate-fade-in"> 

            <FoodCard :meal="meal"></FoodCard>
        </div> -->
    </div>
    <div
        class="flex justify-center items-center flex-col transition-all duration-250 delay-75 ease-bounce sha"
        v-if="hasMoreData"
    >
    </div>
    <!-- {{ $page.props.auth.user }} -->

    <Footer></Footer>
</template>

<style scoped>
.button {
    --color: #1b998b;
    font-family: inherit;
    display: inline-block;
    padding: 0rem 1.5rem;
    height: 2.6em;
    line-height: 2.5em;
    margin: 10px;
    position: relative;
    overflow: hidden;
    border: 2px solid var(--color);
    transition: color 0.5s;
    z-index: 1;
    font-size: 15px;
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




.card::before {
    content: "";
    position: absolute;
    height: 250%;
    width: 250%;
    border-radius: inherit;
    background: #1B998B;
    background: linear-gradient(to right, #1B998B, #1B998B);
    transform-origin: center;
    animation: moving 4.8s linear infinite paused;
    transition: all 0.88s cubic-bezier(0.23, 1, 0.32, 1);
}

.card:hover::before {
    animation-play-state: running;
    z-index: -1;
    width: 20%;
}


.card:hover {
    box-shadow: 0rem 6px 13px rgba(10, 255, 116, 0.1),
        0rem 24px 24px rgba(4, 163, 78, 0.09),
        0rem 55px 33px rgba(10, 60, 255, 0.05),
        0rem 97px 39px rgba(10, 255, 132, 0.01),
        0rem 152px 43px rgba(10, 255, 210, 0);
    scale: 1.05;
    color: #000000;
}

@keyframes moving {
    0% {
        transform: rotate(0);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>
