<script setup>
import { onMounted } from "vue";
import { Head, Link, usePage } from "@inertiajs/vue3";
import Header from "./Header/Index.vue";
import FoodCard from "@/Layouts/FoodCard.vue";
import Footer from "@/Layouts/Footer.vue";
import DateRangePicker from "./Header/DateRangePicker.vue";
import axios from "axios";
import { subscribeUserToPush } from "/resources/js/bootstrap.js"; // Adjust the path as necessary
import { ref, computed } from "vue";



defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    // pushSub: Boolean,
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
    <Header  @filter-meals="filterMeals"   :isHeaderFixed="isHeaderFixed"
    :canLogin="canLogin"
    :canRegister="canRegister"
    :laravelVersion="laravelVersion"
    :phpVersion="phpVersion"
  >   <template v-slot:search-content>
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
                class="hidden lg:flex transition-all duration-300 delay-75 ease-in animate-fade-in"
            ></DateRangePicker>
            <DateRangePicker
                @filter-meals="filterMeals"
                class="lg:hidden transition-all duration-300 delay-75 ease-in animate-fade-in w-full"
            ></DateRangePicker> 
    </template>
        
    </Header>
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
