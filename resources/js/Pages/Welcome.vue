<script setup>
import { Head } from "@inertiajs/vue3";
import DropBarNav from "./Header/DropBarNav.vue";
import FoodCard from "@/Layouts/FoodCard.vue";
import DateRangePicker from "./Header/DateRangePicker.vue";
import Navbar from "./Header/Navbar.vue";
import axios from "axios";
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<script>
export default {
    inheritAttrs: false,
    data() {
        return {
            meals: [],
            isHeaderFixed: false,
        };
    },
    mounted() {
        window.addEventListener("scroll", this.handleScroll);
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.handleScroll);
    },
    created() {
        this.getMeals(), this.handleScroll(),this.filterMeals()
    },
    methods: {
        getMeals() {
            // axios
            //     .get("/api/meals")
            //     .then((response) => {
            //         this.meals = response.data;
            //     })
            //     .catch((error) => {
            //         console.error("Error fetching data:", error);
            //     });
        },
        filterMeals(searchText) {
            axios
                .get(`/api/filtered-meals?query=${searchText}`)
                .then((response) => {
                    this.meals = response.data;
                })
                .catch((error) => {
                    console.error("Error fetching filtered data:", error);
                });
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
    <header
        :class="{ fixed: isHeaderFixed }"
        class="bg-snow dark:bg-oynx z-990 w-screen transition-all duration-300 delay-75 ease-in"
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
                            <p>Meal Schedule</p>
                        </a>
                        <a class="py-2 px-3 navbar-link" href="">
                            <p>Special Meal</p>
                        </a>
                        <a class="py-2 px-3 navbar-link" href="">
                            <p>Explore</p>
                        </a>
                    </div>
                    <template v-else>
                        <DateRangePicker @filter-meals="filterMeals"
                            class="transition-all duration-300 delay-75 ease-in"
                        ></DateRangePicker>
                    </template>
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
        <DateRangePicker @filter-meals="filterMeals"
            v-if="!isHeaderFixed"
            class="transition-all duration-300 delay-75 ease-in"
        ></DateRangePicker>
        <DateRangePicker @filter-meals="filterMeals"
            
            class="  lg:hidden transition-all duration-300 delay-75 ease-in"
        ></DateRangePicker>
    </header>
    <!-- {{ meals }}
<ul   v-for=" meal in meals" >
<li>{{ meal.cook.name }}</li>
</ul> -->

    <div
        class="container mt-4 p-4 lg:p-10 mx-auto relative grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 sm:items-center min-h-screen selection:bg-red-500 selection:text-white bg-snow dark:bg-oynx"
    >
        <div v-for="meal in meals" :key="meal.id">
            <FoodCard :meal="meal"></FoodCard>
        </div>
    </div>
</template>

<style scoped>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
.fixed {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000; /* Adjust z-index as needed */
}
</style>
