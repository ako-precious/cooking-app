<script setup>
import { Head, Link } from "@inertiajs/vue3";

import ApplicationMark from "@/Components/ApplicationMark.vue";
import BecomeCook from "./BecomeCook.vue";
</script>

<template>
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-white"
    >
        <div class="container py-5 relative mx-auto overflow-hidden">
            <div
                :class="{ 'fix align-bottom shadow-sm': isHeaderFixed }"
                class="flex justify-between items-center w-full bg-snow dark:bg-oynx"
            >
                <Link :href="route('welcome')">
                    <div class="w-full flex items-center">
                        <ApplicationMark class="block" />
                    </div>
                </Link>
                <Link :href="`/cook/menu`">
                    <div
                        class="w-32 navbar-link font-semibold shadow-extra-small p-2 text-center rounded-full text-sm"
                    >
                        Exist
                    </div></Link
                >
            </div>
            <div
                class="m-auto flex flex-col max-w-[1000px] justify-center h-full px-6 lg:pb-20 w-full"
            >
                <div class="py-5 lg:py-8 lg:px-10">
                    <h1
                        class="font-semibold text-2xl lg:text-4xl text-oynx dark:text-snow"
                    >
                        Glad you're back,
                        <span class="capitalize">
                            {{ firstWord }}
                            <!-- {{ firstWord($page.props.auth.user.name ) }} -->
                        </span>
                    </h1>
                </div>
                <div class="mb-12">
                    <div class="py-5 lg:px-10">
                        <h1
                            class="font-semibold text-xl lg:text-2xl text-oynx dark:text-snow"
                        >
                            <span class="capitalize">
                                Add a meal to your menu
                            </span>
                        </h1>
                    </div>
                    <div class="lg:w-full">
                        <div class="flex flex-col w-full">
                            <div
                                class="grid grid-cols-1 gap-5 lg:gap-8 lg:px-10"
                            >
                                <div class="col-span-1 w-full max-w-full">
                                    <div
                                        class="flex min-w-0 break-words w-full items-center justify-between group rounded-2xl bg-clip-border cursor-pointer"
                                    >
                                        <Link
                                            class="w-full"
                                            :href="`/become-a-cook/overview`"
                                        >
                                            <div
                                                class="relative flex items-center justify-between w-full p-4 mb-0 list-none rounded-xl"
                                            >
                                                <button
                                                    class="cta flex items-center justify-between w-full lg:px-10 bg-snow text-oynx dark:bg-oynx dark:text-snow"
                                                >
                                                    <div class="relative">
                                                        <img
                                                            src="/images/dishes.png"
                                                            class="relative w-[50px] h-[50px] leading-normal"
                                                            alt=""
                                                        />
                                                        <font-awesome-icon
                                                            class="absolute h-1/3 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-persian"
                                                            icon="plus"
                                                        />
                                                    </div>
                                                    <span
                                                        class="span group-action-text"
                                                        >Create a New Meal</span
                                                    >
                                                    <span class="second">
                                                        <svg
                                                            width="50px"
                                                            height="20px"
                                                            viewBox="0 0 66 43"
                                                            version="1.1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        >
                                                            <g
                                                                id="arrow"
                                                                stroke="none"
                                                                stroke-width="1"
                                                                fill="none"
                                                                fill-rule="evenodd"
                                                            >
                                                                <path
                                                                    class="one"
                                                                    d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z"
                                                                    fill="#1B998B"
                                                                ></path>
                                                                <path
                                                                    class="two"
                                                                    d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z"
                                                                    fill="#1B998B"
                                                                ></path>
                                                                <path
                                                                    class="three"
                                                                    d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z"
                                                                    fill="#1B998B"
                                                                ></path>
                                                            </g>
                                                        </svg>
                                                    </span>
                                                </button>
                                            </div>
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-5 lg:px-10">
                    <h1
                        class="font-semibold text-xl lg:text-2xl text-oynx dark:text-snow"
                    >
                        <span class="capitalize">
                            Continue Setting up your menu
                        </span>
                    </h1>
                </div>
                <div class="lg:w-full">
                    <div class="flex flex-col w-full">
                        <div class="grid grid-cols-1 gap-5 lg:gap-8 lg:px-10">
                            <div
                                v-for="(item, index) in pendingMeals"
                                :key="index"
                                class="col-span-1 w-full max-w-full"
                            >
                                <div
                                    class="flex min-w-0 break-words w-full items-center justify-between shadow-extra-small group rounded-2xl bg-clip-border cursor-pointer"
                                >
                                    <Link
                                        class="w4"
                                        :href="`/become-a-cook/${item.id}/overview`"
                                    >
                                        <div
                                            class="relative flex items-center justify-between w-full p-4 mb-0 list-none rounded-xl"
                                        >
                                            <img
                                                src="/images/dishes.png"
                                                class="w-[30px] h-[30px] leading-normal group-action-text"
                                                alt=""
                                            />

                                            <div class="w-full">
                                                <p
                                                    class="font-semibold px-4 py-2 transition-colors ease-in-out rounded-lg group-action-text"
                                                >
                                                    <span
                                                        v-if="item.name"
                                                        class="lg:text-xl leading-normal"
                                                    >
                                                        {{ item.name }}</span
                                                    >
                                                    <span
                                                        v-else
                                                        class="lg:text-xl leading-normal"
                                                        >Food created on
                                                        {{
                                                            FormattedDate(
                                                                item.created_at
                                                            )
                                                        }}
                                                    </span>
                                                </p>
                                            </div>
                                            <div></div>
                                        </div>
                                    </Link>
                                    <p
                                        class="bottom-1 w-12 top-1 right-1 h-full text-xl cursor-pointer p-2 flex justify-center"
                                        @click="removePending(item.id)"
                                    >
                                        <font-awesome-icon
                                            icon="fa-solid fa-close"
                                            class="text-lighred text-2xl"
                                        />
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    props: {
        pending: Object,
    },
    data() {
        return {
            pendingMeals: this.pending,
            isHeaderFixed: false,
        };
    },
    computed: {
        firstWord() {
            // Check if $page.props.auth.user.name is defined
            if (
                this.$page.props.auth &&
                this.$page.props.auth.user &&
                this.$page.props.auth.user.name
            ) {
                // Split the name string into an array of words
                const words = this.$page.props.auth.user.name.split(" ");

                // Return the first word
                return words[0];
            } else {
                return ""; // Return an empty string if $page.props.auth.user.name is undefined
            }
        },
    },
    mounted() {
        window.addEventListener("scroll", this.handleScroll);
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.handleScroll);
    },
    created() {
        this.FormattedDate();
    },
    methods: {
        removePending(id) {
            // Assuming you have an endpoint to delete the photo from the database
            axios
                .delete(`/meal/${id}`)
                .then((response) => {
                    // console.log(response.data);
                    this.pendingMeals = response.data.pending;

                    // Handle success if needed
                })
                .catch((error) => {
                    // console.error("Error deleting meal photo:", error);
                });
        },
        handleScroll() {
            // Adjust the scroll threshold as needed
            const scrollThreshold = 20;
            this.isHeaderFixed = window.scrollY > scrollThreshold;
        },

        FormattedDate(timestamp) {
            const date = new Date(timestamp);
            const formattedDate = `${date.getFullYear()}-${(date.getMonth() + 1)
                .toString()
                .padStart(2, "0")}-${date
                .getDate()
                .toString()
                .padStart(2, "0")} at ${date.getHours()}:${date
                .getMinutes()
                .toString()
                .padStart(2, "0")}`;
            return formattedDate;
        },
    },
};
</script>

<style scoped>
.cta {
    display: flex;
    padding: 11px 33px;
    text-decoration: none;
    font-family: "Poppins", sans-serif;
    font-size: 25px;
    transition: 1s;
    box-shadow: 6px 6px 0 black;
    transform: skewX(-10deg);
    border: none;
}

.cta:focus {
    outline: none;
}

.cta:hover {
    transition: 0.5s;
    box-shadow: 10px 10px 0 #1b998b;
}

.cta .second {
    transition: 0.5s;
    margin-right: 0px;
}

.cta:hover .second {
    transition: 0.5s;
    margin-right: 45px;
}

.span {
    transform: skewX(15deg);
}

.second {
    width: 20px;
    margin-left: 30px;
    position: relative;
    top: 12%;
}

.one {
    transition: 0.4s;
    transform: translateX(-60%);
}

.two {
    transition: 0.5s;
    transform: translateX(-30%);
}

.cta:hover .three {
    animation: color_anim 1s infinite 0.2s;
}

.cta:hover .one {
    transform: translateX(0%);
    animation: color_anim 1s infinite 0.6s;
}

.cta:hover .two {
    transform: translateX(0%);
    animation: color_anim 1s infinite 0.4s;
}

@keyframes color_anim {
    0% {
        fill: black;
    }

    50% {
        fill: #1b998b;
    }

    100% {
        fill: white;
    }
}

@keyframes fade-in {
    from {
        opacity: 0;
        bottom: -10rem;
    }
    to {
        opacity: 1;
        bottom: 0;
    }
}

.animate-fade-in {
    animation: fade-in 0.7s ease-in;
}
.fix {
    position: fixed;
    top: 0;
    right: 0;
    width: 100%;
    padding: 1rem 3rem;
    z-index: 1000; /* Adjust z-index as needed */
}
</style>
