<script setup>
import { Head } from "@inertiajs/vue3";
import DropBarNav from "@/Pages/Header/DropBarNav.vue";
import FoodCard from "@/Layouts/FoodCard.vue";
import Footer from "@/Layouts/Footer.vue";
import Navbar from "@/Pages/Header/Navbar.vue";
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
    },
    created() {
       this.handleScroll(); this.fetchData();
    },
    methods: {
        
        async   filterMeals(searchText) {
            await  axios
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
    <Head title="Wishlist" />
    <!-- component -->
    <div class="">

        <header
            :class="{ fix: isHeaderFixed }"
            class= "py-5 bg-snow dark:bg-oynx z-990 transition-all  duration-300 delay-75 ease-in animate-fade-in"
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
            
        </header>
    </div>
    <div
        class="container mt-4 p-4 lg:p-10 mx-auto relative grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 sm:items-center min-h-screen selection:bg-red-500 selection:text-white bg-snow dark:bg-oynx"
    >
        <div v-for="meal in meals" :key="meal.id" class="animate-fade-in ">
            <FoodCard :meal="meal"></FoodCard>
        </div>
    </div>
    <div class="flex justify-center items-center flex-col transition-all duration-250 delay-75 ease-bounce" v-if="hasMoreData">
        
        <button  @click="loadMoreData">Show More </button>
    </div>
    <Footer></Footer>
</template>

<style scoped>
button {
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

button:before {
    content: "";
    position: absolute;
    z-index: -1;
    background: var(--color);
    height: 150px;
    width: 200px;
    border-radius: 50%;
}

button:hover {
    color: #fff;
}

button:before {
    top: 100%;
    left: 100%;
    transition: all 0.7s;
}

button:hover:before {
    top: -30px;
    left: -30px;
}

button:active:before {
    background: #0e534b;
    transition: background 0s;
}
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
.fix  {
    position: fixed;
    top: 0;
    right: 0;
    width: 100%;
    padding: 1rem 2rem;
    z-index: 1000; /* Adjust z-index as needed */
}

@keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .animate-fade-in {
        animation: fade-in 0.3s ease-in;
    }
</style>
