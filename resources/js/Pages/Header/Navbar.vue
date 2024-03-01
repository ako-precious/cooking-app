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
                <!-- <li class="navbar-link">
                    <a class="" href="">
                        <font-awesome-icon
                            icon="globe"
                            class="h-3 lg:h-4 p-2 svg-inline--fa fa-user fa-w-14 fa-9x"
                        />
                    </a>
                </li> -->
                <li class="navbar-link">
                    <Dropdown>
                        <template #trigger>
                          
                                <font-awesome-icon
                                    icon="bell"
                                    class="h-3 lg:h-4 p-2 svg-inline--fa fa-user fa-w-14 fa-9x"
                                />
                            
                        </template>

                        <template #content>
            <!-- Account Management -->
            <div
                   
                    id="dropdown-menu"
                    class="origin-top-right absolute right-0 mt-2 w-48 delay-75 rounded-md border-snow  ring-1 bg-gradient-to-br from-[#e3dedf] to-[#ffffff] -shadow-snow-sm hover:shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37]  dark:-shadow-oynx-sm hover:dark:shadow-oynx-sm z-20 transition-all duration-250 ease-in dark:border-oynx"
                >
                    <div 
                        class="py-2 p-2"
                        role="menu"
                        aria-orientation="vertical"
                        aria-labelledby="dropdown-button"
                    >
                     <div v-for="notification in notifications">  
                        <a
                            @click="selectTheme('light')"
                            class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer"
                            role="menuitem"
                        >
                            <svg
                                xmlns="http://www.w3.org/1500/svg"
                                viewBox="0 0 15 15"
                                id="light"
                                width="18px"
                                class="mr-2"
                            >
                                <path
                                    d="M19 9.199h-.98c-.553 0-1 .359-1 .801 0 .441.447.799 1 .799H19c.552 0 1-.357 1-.799 0-.441-.449-.801-1-.801zM10 4.5A5.483 5.483 0 0 0 4.5 10c0 3.051 2.449 5.5 5.5 5.5 3.05 0 5.5-2.449 5.5-5.5S13.049 4.5 10 4.5zm0 9.5c-2.211 0-4-1.791-4-4 0-2.211 1.789-4 4-4a4 4 0 0 1 0 8zm-7-4c0-.441-.449-.801-1-.801H1c-.553 0-1 .359-1 .801 0 .441.447.799 1 .799h1c.551 0 1-.358 1-.799zm7-7c.441 0 .799-.447.799-1V1c0-.553-.358-1-.799-1-.442 0-.801.447-.801 1v1c0 .553.359 1 .801 1zm0 14c-.442 0-.801.447-.801 1v1c0 .553.359 1 .801 1 .441 0 .799-.447.799-1v-1c0-.553-.358-1-.799-1zm7.365-13.234c.391-.391.454-.961.142-1.273s-.883-.248-1.272.143l-.7.699c-.391.391-.454.961-.142 1.273s.883.248 1.273-.143l.699-.699zM3.334 15.533l-.7.701c-.391.391-.454.959-.142 1.271s.883.25 1.272-.141l.7-.699c.391-.391.454-.961.142-1.274s-.883-.247-1.272.142zm.431-12.898c-.39-.391-.961-.455-1.273-.143s-.248.883.141 1.274l.7.699c.391.391.96.455 1.272.143s.249-.883-.141-1.273l-.699-.7zm11.769 14.031l.7.699c.391.391.96.453 1.272.143.312-.312.249-.883-.142-1.273l-.699-.699c-.391-.391-.961-.455-1.274-.143s-.248.882.143 1.273z"
                                ></path>
                            </svg>
                            {{ notification }}
                        </a></div> 
                        <a
                            @click="selectTheme('dark')"
                            class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer"
                            role="menuitem"
                        >
                            <svg
                                xmlns="http://www.w3.org/1500/svg"
                                viewBox="0 0 24 24"
                                id="moon"
                                width="18px"
                                class="mr-2"
                            >
                                <path
                                    d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z"
                                ></path>
                            </svg>
                            Dark
                        </a>
                        <a
                            @click="selectTheme('system')"
                            class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer"
                            role="menuitem"
                        >
                            <svg
                                xmlns="http://www.w3.org/1500/svg"
                                width="16px"
                                class="mr-2"
                                viewBox="0 0 32 32"
                                id="desktop"
                            >
                                <path
                                    d="M30 2H2a2 2 0 0 0-2 2v18a2 2 0 0 0 2 2H9.998c-.004 1.446-.062 3.324-.61 4h-.404A.992.992,0,0,0,10,29c0 .552.44 1,.984 1h10.03A.992.992,0,0,0,22,29c0-.552-.44-1-.984-1h-.404c-.55-.676-.606-2.554-.61-4H30a2 2,0,0,0,2-2V4a2,2,0,0,0-2-2zM14 24l-.002.004L14 24zm4.002.004L18 24h.002v.004zM30 15H2V4h28v16z"
                                ></path>
                            </svg>
                            System
                        </a>
                    </div>
                </div>
        </template>
                    </Dropdown>
                </li>
                <slot name="dropdown"> </slot>
            </ul>
        </nav>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
// import route from "vendor/tightenco/ziggy/src/js";
</script>

<script>
import axios from "axios";
export default {
    data() {
        return {
            check: false,
            notifications: '',
        };
    },
    created() {
        this.chekUser(); // Fetch images from the backend when the component is created
    },
    methods: {
        chekUser() {
            axios
                .get("/checkUser")
                .then((response) => {
                    this.check = response.data.checkUser;
                })
                .catch((error) => {
                    // Handle error
                    console.error("Error saving data:", error);
                });
        },
        checkNotification() {
            axios
                .get("/checkUser")
                .then((response) => {
                    this.notifications = response.data.notifications;
                })
                .catch((error) => {
                    // Handle error
                    console.error("Error saving data:", error);
                });
        },
    },
};
</script>
<style>
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
