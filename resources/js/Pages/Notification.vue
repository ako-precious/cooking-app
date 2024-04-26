<script setup>
import DropBarNav from "./Header/DropBarNav.vue";
import Footer from "@/Layouts/Footer.vue";
import { Head, Link, router } from "@inertiajs/vue3";
import Navbar from "./Header/Navbar.vue";
import axios from "axios";
</script>

<script>
export default {
    inheritAttrs: false,
    props: {
        notifications: Object, // Prop to receive paginated notifications data from Inertia
    },
    data() {
        return {
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
        this.handleScroll();
    },
    methods: {
        loadPreviousPage() {
            // Send an Inertia request to the previous page using the `notifications.links.prev` URL

            this.$inertia.visit(this.notifications.prev_page_url);
        },
        loadNextPage() {
            // Send an Inertia request to the next page using the `notifications.links.next` URL
            this.$inertia.visit(this.notifications.next_page_url);
        },
        loadNext(link) {
            // Send an Inertia request to the next page using the `notifications.links.next` URL
            this.$inertia.visit(link);
        },
        updateStatus(){
            axios.put('/notifications/status', {
                status: 'read' // or 'inactive' depending on your requirement
            })
            .then(response => {
                console.log(response.data);
            })
            .catch(error => {
                console.error(error);
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
    <Head title="Notification" />
    <!-- component -->
    <div class="">
        <header
            :class="{ fix: isHeaderFixed }"
            class="py-5 bg-snow dark:bg-oynx z-990 transition-all duration-300 delay-75 ease-in animate-fade-in"
        >
            <Navbar class="bg-snow dark:bg-oynx">
                <template #search>
                    <div
                        class="w-full p-4 max-w-xs lg:max-w-lg 2xl:max-w-2xl bg-snow dark:bg-oynx rounded-md hidden lg:flex items-center"
                    ></div>
                </template>
                <template #dropdown>
                    <DropBarNav />
                </template>
            </Navbar>
        </header>
    </div>
    <div
        class="container mt-4 p-4 lg:p-10 mx-auto relative gap-8 sm:items-center min-h-screen selection:bg-red-500 selection:text-white bg-snow dark:bg-oynx"
    >
        <div class="flex flex-col w-full">
            <div class="grid grid-cols-1 gap-5 lg:gap-8 lg:px-10">
                <div v-if="notifications.data.length > 0">
                    <div
                        v-for="notification in notifications.data"
                        :key="notification.id"
                        class="col-span-1 mb-5 w-full max-w-full"
                    >
                        <div
                            class="relative flex min-w-0 break-words w-full items-center justify-between shadow-extra-small shadow-xxs border group rounded-2xl bg-clip-border cursor-pointer"
                        >
                            <Link class="w4" :href="`/meal-schedule`">
                                <div
                                    class="relative flex items-center justify-between w-full p-4 mb-0 list-none rounded-xl"
                                >
                                    <div class="w-full">
                                        <p
                                            class="font-semibold px-4 py-2 transition-colors ease-in-out rounded-lg group-action-text"
                                        >
                                            <span
                                                class="lg:text-xl leading-normal"
                                            >
                                                {{ notification.message }}</span
                                            >
                                        </p>
                                    </div>
                                    <div></div>
                                </div>
                            </Link>
                            <div
                        v-if="notification.status == 'unread' "
                        class="absolute top-[20%] right-[10%]"
                    >
                        <div
                            class="bg-persian  w-[22px] h-[22px] rounded-full flex items-center justify-center"
                        >
                            <p class="text-xs font-bold text-persian">1</p>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
                <div v-else>No notifications found.</div>
                <div v-if="notifications.links">
                    <!-- component -->
                    <div
                        class="flex items-center justify-center py-10 w-full lg:px-0 sm:px-6 px-4"
                    >
                        <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->

                        <div
                            class="w-full flex items-center justify-between border-t border-gray-200"
                        >
                            <div
                                class="flex items-center pt-3 text-gray-600 hover:text-persian cursor-pointer"
                            >
                                <p
                                    v-if="notifications.prev_page_url"
                                    @click.prevent="loadPreviousPage"
                                    class="text-sm ml-3 font-medium leading-none"
                                >
                                    Previous
                                </p>
                            </div>

                            <div
                                class="sm:flex hidden"
                                v-for="(link, index) in notifications.links"
                            >
                                <div
                                    v-if="
                                        index > 0 &&
                                        index < notifications.links.length - 1
                                    "
                                >
                                    <p
                                        @click.prevent="loadNext(link.url)"
                                        v-if="link.active == true"
                                        class="text-sm font-medium leading-none cursor-pointer text-persian border-t border-persian pt-3 mr-4 px-2"
                                    >
                                        {{ link.label }}
                                    </p>
                                    <p
                                        @click.prevent="loadNext(link.url)"
                                        v-else
                                        class="text-sm font-medium leading-none cursor-pointer text-gray-600 hover:text-persian border-t border-transparent hover:border-persian pt-3 mr-4 px-2"
                                    >
                                        {{ link.label }}
                                    </p>
                                </div>
                            </div>
                            <div
                                class="flex items-center pt-3 text-gray-600 hover:text-persian cursor-pointer"
                            >
                                <p
                                    v-if="notifications.next_page_url"
                                    @click.prevent="loadNextPage"
                                    class="text-sm font-medium leading-none mr-3"
                                >
                                    Next
                                </p>
                            </div>
                        </div>
                    </div>
                   
                </div>
               <p class="cursor-pointer "  @click="updateStatus"> Mark as read</p>
            </div>
        </div>
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
.fix {
    position: fixed;
    top: 0;
    right: 0;
    width: 100%;
    padding: 1rem 2rem;
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
