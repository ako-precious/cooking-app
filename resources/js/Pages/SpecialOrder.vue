<script setup>
import { onMounted } from "vue";
import { Head, usePage, Link } from "@inertiajs/vue3";
import Footer from "@/Layouts/Footer.vue";
import DateRangePicker from "./Header/DateRangePicker.vue";
import Header from "./Header/Index.vue";
import FoodCard from "@/Layouts/FoodCard.vue";
import axios from "axios";
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
            hasSpecialOffer: false,
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
        this.QualifyUser()
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
                    `/meals?page=${this.page}&perPage=${this.perPage}`
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

        async QualifyUser() {
            try {
            const response = await axios.get(`/special-user`);
            const newMeals = parseInt(response.data.special_count);
            console.log(newMeals);
            
            // If there is no new data, set hasMoreData to false
            if (newMeals > 5) {
                this.hasSpecialOffer = true;
            }
            console.log( this.hasSpecialOffer);
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
    <Header
        @filter-meals="filterMeals"
        :isHeaderFixed="isHeaderFixed"
        :canLogin="canLogin"
        :canRegister="canRegister"
        :laravelVersion="laravelVersion"
        :phpVersion="phpVersion"
    >
        <template v-slot:search-content>
            <DateRangePicker
                @filter-meals="filterMeals"
                v-if="isHeaderFixed"
                class="transition-all duration-300 delay-75 ease-in"
            ></DateRangePicker>
        </template>
        <template v-slot:extra-content>
            <DateRangePicker
                v-if="!isHeaderFixed"
                @filter-meals="filterMeals"
                class="hidden lg:flex transition-all duration-300 delay-75 ease-in w-full animate-fade-in"
            ></DateRangePicker>
            <DateRangePicker
                @filter-meals="filterMeals"
                class="lg:hidden transition-all duration-300 delay-75 ease-in animate-fade-in w-full"
            ></DateRangePicker>
        </template>
    </Header>
    <!-- <div
       
        class="container p-4 lg:p-10 mx-auto relative grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 sm:items-center min-h-screen selection:bg-red-500 selection:text-white bg-snow dark:bg-oynx"
    >
        <div v-for="meal in meals" :key="meal.id" class="animate-fade-in">
            Bulk Meal Page
            <FoodCard :meal="meal"></FoodCard>
        </div>
    </div> -->
    <div v-if="hasSpecialOffer"
        
        class="container p-4 lg:p-10 mx-auto relative flex justify-center gap-8 items-center min-h-screen selection:bg-red-500 selection:text-white bg-snow dark:bg-oynx"
    >
        <div
            class="card md:w-[600px] relative flex justify-center items-center w-[420px] p-[2px] rounded-[22px] overflow-hidden leading-6 transition-all duration-[4800] ease-in-out group"
        >
            <div
                class="flex flex-col justify-center items-center w-full gap-[24px] p-[20px] rounded-[22px] bg-snow dark:bg-oynx text-snow dark:group-hover:text-snow group-hover:text-oynx overflow-hidden transition-all duration-480 ease-in-out"
            >
                <p
                    class="font-bold text-4xl leading-tight z-10 transition-all duration-480 ease-in-out"
                >
                     Special Meal
                </p>
                <p
                    class="z-index-1 opacity-80 text-lg transition-all duration-480 ease-in-out"
                >
                    <span class="text-base">
                        Customize your meal for special occasions or dietary needs</span
                    ><br />
                   
                </p>

                <Link :href="route('welcome')" class="button items-center flex"
                    >hhj</Link
                >
            </div>
        </div>
    </div>
    <div
        v-else
        class="container p-4 lg:p-10 mx-auto relative flex justify-center gap-8 items-center min-h-screen selection:bg-red-500 selection:text-white bg-snow dark:bg-oynx"
    >
        <div
            class="card md:w-[600px] relative flex justify-center items-center w-[420px] p-[2px] rounded-[22px] overflow-hidden leading-6 transition-all duration-[4800] ease-in-out group"
        >
            <div
                class="flex flex-col justify-center items-center w-full gap-[24px] p-[20px] rounded-[22px] bg-snow dark:bg-oynx text-snow dark:group-hover:text-snow group-hover:text-oynx overflow-hidden transition-all duration-480 ease-in-out"
            >
                <p
                    class="font-bold text-4xl leading-tight z-10 transition-all duration-480 ease-in-out"
                >
                    Unlock Special Orders
                </p>
                <p
                    class="z-index-1 opacity-80 text-lg transition-all duration-480 ease-in-out"
                >
                    <span class="text-base">
                        To access special orders, please complete a minimum of 5
                        orders from our talented cooks. This helps us understand
                        your preferences and serve you better.</span
                    ><br />
                    <b> Browse Our Cooks & Start Ordering!</b>
                    <span class="text-base">
                        <br />
                        - Explore our platform to discover new cooks
                        <br />
                        - Try their delicious dishes and earn loyalty points
                        <br />
                        - Unlock special orders and tailor meals to your taste
                    </span>
                </p>

                <Link :href="route('welcome')" class="button items-center flex"
                    >View Meals</Link
                >
            </div>
        </div>
    </div>
    <!-- {{}} -->
    <!-- <div
        class="flex justify-center items-center flex-col transition-all duration-250 delay-75 ease-bounce sha"
        v-if="hasMoreData"
    ></div> -->
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
    height:350%;
    width: 350%;
    border-radius: inherit;
    background: #1b998b;
    background: linear-gradient(to right, #1b998b, #1b998b);
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
