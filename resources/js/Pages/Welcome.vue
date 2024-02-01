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
        };
    },
    created() {
        this.getMeals()
    },
    methods: {
      
        getMeals() {
            axios
                .get("/api/meals")
                .then((response) => {
                    this.meals = response.data;                   
                })
                .catch((error) => {
                    console.error("Error fetching data:", error);
                });
        },


    },
};
</script>

<template>
  
    <Head title="Welcome" />

    <!-- component -->
    <header class="bg-snow dark:bg-oynx">
        <Navbar>
            <DropBarNav
                :canLogin="canLogin"
                :canRegister="canRegister"
                :laravelVersion="laravelVersion"
                :phpVersion="phpVersion"
            />
        </Navbar>
        <DateRangePicker></DateRangePicker>
        <hr />
    </header>
<!-- {{ meals }}
<ul   v-for=" meal in meals" >
<li>{{ meal.cook.name }}</li>
</ul> -->
    
    <div 
        class="container px-4 lg:p-10 mx-auto relative grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 sm:items-center min-h-screen selection:bg-red-500 selection:text-white bg-snow dark:bg-oynx  "
   > <div v-for=" meal in meals">

       <FoodCard :meal="meal" ></FoodCard>
    </div>
    </div>
   </template> 

<style scoped>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

.input {
    /* width: 200px; */
    height: 45px;
    border: none;
    outline: none;

    border-radius: 6px;
    color: #fff;
    font-size: 15px;
    background-color: transparent;
    border-radius: 53px;
    background: linear-gradient(145deg, #cacaca, #f0f0f0);
    box-shadow: 25px 25px 50px #727272, -25px -25px 50px #ffffff;
    /* box-shadow: 3px 3px 10px rgba(0,0,0,1),
  -1px -1px 6px rgba(255, 255, 255, 0.4); */
}

.input:focus {
    border: 2px solid transparent;
    color: #fff;
    box-shadow: 3px 3px 10px rgba(0, 0, 0, 1),
        -1px -1px 6px rgba(255, 255, 255, 0.4),
        inset 3px 3px 10px rgba(0, 0, 0, 1),
        inset -1px -1px 6px rgba(255, 255, 255, 0.4);
}

.divcontainer .input:valid,
.divcontainer .input:focus {
    box-shadow: 3px 3px 10px rgba(0, 0, 0, 1),
        -1px -1px 6px rgba(255, 255, 255, 0.4),
        inset 3px 3px 10px rgba(0, 0, 0, 1),
        inset -1px -1px 6px rgba(255, 255, 255, 0.4);
}
</style>
