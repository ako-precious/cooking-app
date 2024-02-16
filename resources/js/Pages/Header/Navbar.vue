<template>
    <div
        class="container mx-auto px-4 lg:px-10 flex justify-between items-center"
    >
        <!-- logo -->
        <div class="md:w-48 flex-shrink-0">
            <img
                class="h-8 md:h-10"
                src="https://i.ibb.co/98pHdFq/2021-10-27-15h51-15.png"
                alt=""
            />
        </div>

        <!-- search -->
        <slot name="search"></slot>

        <!-- buttons -->
        <nav class="contents">
            <ul class="ml-4 xl:w-48 flex items-center justify-end">
                <!-- hso -->

                <li v-if="check" class="text-nowrap py-2 px-4 navbar-link">
                    <Link :href="`/cook/menu`">
                        <a class="" href="">
                            <p>Your Menu</p>
                        </a>
                    </Link>
                </li>
                <li v-else class="text-nowrap py-2 px-4 navbar-link">
                    <Link :href="`/cook/setup`">
                        <a class="" href="">
                            <p>Be a Cook</p>
                        </a>
                    </Link>
                </li>
                <li  class="navbar-link">
                    <a class="" href="">
                        <font-awesome-icon
                            icon="globe"
                            class="h-3 lg:h-4 p-2 svg-inline--fa fa-user fa-w-14 fa-9x"
                        />
                    </a>
                </li>
                <slot name="dropdown"> </slot>
            </ul>
        </nav>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
// import route from "vendor/tightenco/ziggy/src/js";
</script>

<script>

import axios from 'axios';
export default {
   
    data() {
        return {
           
            check:false ,
        };
    },
    created() {
        this.chekUser(); // Fetch images from the backend when the component is created
    },
    methods: {
        chekUser() {
            axios
                    .get("/checkUser" )
                    .then((response) => {
                    this.check = response.data.checkUser                       
                    })
                    .catch((error) => {
                        // Handle error
                        console.error("Error saving data:", error);
                    });
        },
    }


};
</script>
<style>
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
