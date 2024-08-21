<script setup>
import { Head, Link } from "@inertiajs/vue3";
import axios from "axios";
import Card from "./Card.vue";
import Availability from "./Partials/Availability.vue"
import Navbar from "../Header/Navbar.vue";
import DropBarNav from "../Header/DropBarNav.vue";
import Footer from "@/Layouts/Footer.vue";
import OtherInfo from "./Partials/OtherInfo.vue";
</script>
<template>
    <Head title="Cook's Profile" />

    <header
        :class="{
            'fix align-bottom shadow-sm py-4 px-8 lg ': isHeaderFixed,
        }"
        class="py-5 bg-snow dark:bg-oynx z-990 transition-all duration-300 delay-75 ease-in animate-fade-in"
    >
        <Navbar class="bg-snow dark:bg-oynx">
            <template #dropdown>
                <DropBarNav />
            </template>
        </Navbar>
    </header>

    <section class="pt-16 bg-snow dark:bg-oynx">
        <div class="lg:w-4/5 px-4 mx-auto">
            <div
                class="relative flex flex-col min-w-0 break-words shadow-reverse w-full mb-6 rounded-lg mt-16"
            >
                <div class="px-6">
                    <div class="flex flex-wrap justify-center">
                        <div
                            class="w-full px-4 flex lg:hidden justify-center lg:justify-between gap-4"
                        >
                            <div class="w-1/2">
                                <div
                                    class="relative w-full flex justify-center items-center"
                                >
                                    <img
                                        v-if="user.profile_photo_path"
                                        :src="
                                            getProfilePhotoUrl(
                                                user.profile_photo_path
                                            )
                                        "
                                        class="shadow-xl rounded-full h-auto align-middle border-none absolute -my-20 mx-auto max-w-40"
                                        alt="avatar"
                                    />
                                    <img
                                        v-else
                                        :src="`https://ui-avatars.com/api/?name=${user.name}&color=FE6D73&background=004E98`"
                                        class="shadow-xl rounded-full h-auto align-middle border-none absolute -my-20 mx-auto max-w-40"
                                        alt="avatar"
                                    />
                                </div>
                            </div>
                        </div>
                        <div
                            class="w-full hidden px-4 lg:flex justify-between gap-4"
                        >
                            <div class="lg:flex py-4 lg:pt-4 lg:w-4/12">
                                <div class="p-3 text-center">
                                    <span
                                        class="text-xl font-bold block uppercase tracking-wide text-oynx dark:text-snow"
                                    >
                                        {{ timeCooking }}
                                    </span>
                                    <span
                                        class="text-xs text-oynx dark:text-snow"
                                    >
                                        {{ CookingDate }} Cooking</span
                                    >
                                </div>
                                <div class="p-3 text-center">
                                    <span
                                        class="text-xl font-bold block uppercase tracking-wide text-oynx dark:text-snow"
                                    >
                                        {{ ratings.toFixed(1) }}
                                    </span>
                                    <span
                                        class="text-xs text-oynx dark:text-snow"
                                        >Rating</span
                                    >
                                </div>
                                <div class="p-3 text-center">
                                    <span
                                        class="text-xl font-bold block uppercase tracking-wide text-oynx dark:text-snow"
                                    >
                                        {{ reviews.length }}
                                    </span>
                                    <span
                                        class="text-xs text-oynx dark:text-snow"
                                        >Review(s)</span
                                    >
                                </div>
                            </div>
                            <div class="w-4/12">
                                <div
                                    class="relative w-full flex items-center justify-center"
                                >
                                    <img
                                        v-if="user.profile_photo_path"
                                        :src="
                                            getProfilePhotoUrl(
                                                user.profile_photo_path
                                            )
                                        "
                                        class="shadow-xl rounded-full h-auto align-middle border-none absolute -my-20 mx-auto max-w-54"
                                        alt="avatar"
                                    />
                                    <img
                                        v-else
                                        :src="`https://ui-avatars.com/api/?name=${user.name}&color=FE6D73&background=004E98`"
                                        class="shadow-xl rounded-full h-auto align-middle border-none absolute -my-20 mx-auto max-w-54"
                                        alt="avatar"
                                    />
                                    <!-- <img alt="..." src="https://demos.creative-tim.com/notus-js/assets/img/team-2-800x800.jpg" class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px"> -->
                                </div>
                            </div>
                            <div
                                class="hidden lg:block text-center lg:w-4/12 mt-6"
                            >
                                <h3
                                    class="text-xl font-semibold leading-normal mb-2 text-oynx dark:text-snow capitalize"
                                >
                                    {{ user.name }}
                                </h3>
                                <div
                                    class="text-sm leading-normal mt-0 mb-2 text-oynx dark:text-snow font-bold uppercase"
                                >
                                    <i
                                        class="fas fa-map-marker-alt mr-2 text-lg text-oynx dark:text-snow"
                                    ></i>
                                    {{ extractCityAndCountry(user.address) }}
                                </div>
                            </div>
                        </div>
                        <div
                            class="block lg:hidden w-full px-4 text-center mt-20"
                        >
                            <div class="flex justify-center py-4 lg:pt-4 pt-8">
                                <div class="p-3 text-center">
                                    <span
                                        class="text-xl font-bold block uppercase tracking-wide text-oynx dark:text-snow"
                                    >
                                        {{ timeCooking }}
                                    </span>
                                    <span
                                        class="text-xs text-oynx dark:text-snow"
                                    >
                                        {{ CookingDate }} Cooking</span
                                    >
                                </div>
                                <div class="p-3 text-center">
                                    <span
                                        class="text-xl font-bold block uppercase tracking-wide text-oynx dark:text-snow"
                                    >
                                        {{ ratings.toFixed(1) }}
                                    </span>
                                    <span
                                        class="text-xs text-oynx dark:text-snow"
                                        >Rating</span
                                    >
                                </div>
                                <div class="p-3 text-center">
                                    <span
                                        class="text-xl font-bold block uppercase tracking-wide text-oynx dark:text-snow"
                                    >
                                        {{ reviews.length }}
                                    </span>
                                    <span
                                        class="text-xs text-oynx dark:text-snow"
                                        >Review(s)</span
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block lg:hidden text-center mt-6">
                        <h3
                            class="text-xl font-semibold leading-normal mb-2 text-oynx dark:text-snow capitalize"
                        >
                            {{ user.name }}
                        </h3>
                        <div
                            class="text-sm leading-normal mt-0 mb-2 text-oynx dark:text-snow font-bold uppercase"
                        >
                            <i
                                class="fas fa-map-marker-alt mr-2 text-lg text-oynx dark:text-snow"
                            ></i>
                            {{ user.address }}
                        </div>
                    </div>
                    <div
                        v-if="$page.props.auth.user"
                        class="py-10 border-t px-4 border-gray-500 flex justify-between"
                    >
                        <div>
                            <p
                                v-if="
                                    user.id == $page.props.auth.user.id ||
                                    cook.question1 == null
                                "
                                class="text-sm leading-relaxed text-oynx dark:text-snow"
                            >
                                <span
                                    v-if="
                                        cook.question3 == null ||
                                        cook.question2 == null ||
                                        cook.question1 == null
                                    "
                                >
                                    <span
                                        @click="openModal"
                                        class="font-bold text-persian hover:text-polynesian dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                                        >Answer questions that makes the your
                                        customer know you more</span
                                    >
                                </span>
                                <span v-else>
                                    <span
                                        @click="openModal"
                                        class="font-bold text-persian hover:text-polynesian dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                                    >
                                        Edit Information Provided
                                    </span>
                                </span>
                            </p>
                        </div>
                        <div>
                            <p
                                v-if="
                                    user.id == $page.props.auth.user.id
                                "
                                class="text-sm leading-relaxed text-oynx dark:text-snow"
                            >
                                <span
                                    @click="openAvailable"
                                    class="font-bold text-persian hover:text-polynesian dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                                    >Select Days Available</span
                                >
                            </p>
                        </div>
                    </div>
                    <div class="py-10 border-t border-gray-500 text-center">
                        <div class="flex flex-wrap justify-center">
                            <div class="text-left w-full px-4">
                                <p
                                    class="mb-4 text-xl font-bold text-center leading-relaxed text-oynx dark:text-snow"
                                >
                                    About {{ firstWord }}
                                </p>

                                <p
                                    class="mb-1 text-lg font-semibold leading-relaxed text-polynesian dark:text-lighred"
                                >
                                    Interesting fact:
                                </p>

                                <p
                                    class="mb-4 text-sm leading-relaxed text-oynx dark:text-snow"
                                >
                                    {{ user.other_info }}
                                </p>

                                <p
                                    class="mb-1 text-lg font-semibold leading-relaxed text-polynesian dark:text-lighred"
                                >
                                    A brief background, cooking experience, and
                                    favorite dish to prepare:
                                </p>
                                <p
                                    class="mb-4 text-sm leading-relaxed text-oynx dark:text-snow"
                                >
                                    {{ cook.question1 }}
                                </p>
                                <p
                                    class="mb-1 text-lg font-semibold leading-relaxed text-polynesian dark:text-lighred"
                                >
                                    What makes {{ firstWord }} cooking unique,
                                    and what you can expect from the dishes:
                                </p>
                                <p
                                    class="mb-4 text-sm leading-relaxed text-oynx dark:text-snow"
                                >
                                    {{ cook.question2 }}
                                </p>
                                <p
                                    class="mb-1 text-lg font-semibold leading-relaxed text-polynesian dark:text-lighred"
                                >
                                    How {{ firstWord }} ensures food safety and
                                    hygiene in the cooking and packaging
                                    process:
                                </p>
                                <p
                                    class="mb-4 text-sm leading-relaxed text-oynx dark:text-snow"
                                >
                                    {{ cook.question3 }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="py-10 border-t border-gray-500 text-center mx-auto relative"
                    >
                        <p
                            class="mb-4 text-xl font-bold text-center leading-relaxed text-oynx dark:text-snow"
                        >
                            {{ firstWord }}'s Meals
                        </p>

                        <div
                            class="py-5 text-center mx-auto relative grid s md:grid-cols-3 sm:grid-cols-2 gap-8"
                        >
                            <div
                                v-for="meal in meals"
                                :key="meal.id"
                                class="animate-fade-in"
                            >
                                <Card :meal="meal"></Card>
                            </div>
                        </div>
                    </div>
                    <div
                        class="py-10 border-t border-gray-500 text-center mx-auto relative"
                    >
                        <p
                            class="mb-4 text-xl font-bold text-center leading-relaxed text-oynx dark:text-snow"
                        >
                            {{ firstWord }}'s Reviews
                        </p>
                        <div class="flex flex-col py-8 md:px-6 lg:p-8">
                            <div
                                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 auto-cols-fr"
                            >
                                <!--Background-->

                                <div
                                    v-for="comment in reviews"
                                    :key="comment.id"
                                    class="animate-fade-in"
                                >
                                    <div class="col-span-1 rounded-3">
                                        <div class="m-4 block rounded-lg">
                                            <!--Testimonial-->
                                            <div class="md:flex md:flex-row">
                                                <div
                                                    class="mx-auto mb-6 flex flex-row md:flex-col justify-between items-center w-36 md:w-1/3 md:mx-0 lg:mb-0"
                                                >
                                                    <img
                                                        v-if="
                                                            comment.profile_photo_path
                                                        "
                                                        src="comment.profile_photo_path"
                                                        class="rounded-full shadow-md dark:shadow-black/30"
                                                        alt="woman avatar"
                                                    />
                                                    <img
                                                        v-else
                                                        :src="`https://ui-avatars.com/api/?name=${comment.user.name}&color=FE6D73&background=004E98`"
                                                        class="rounded-full shadow-md dark:shadow-black/30"
                                                        alt="woman avatar"
                                                    />
                                                    <div class="">
                                                        <div
                                                            class="flex items-center my-3"
                                                        >
                                                            <div
                                                                v-for="index in getStars(
                                                                    comment.total
                                                                )"
                                                                :key="index"
                                                            >
                                                                <font-awesome-icon
                                                                    icon="star"
                                                                    class="text-persian text-xxs"
                                                                />
                                                            </div>
                                                        </div>
                                                        <p
                                                            class="mb-2 text-xs font-bold text-oynx dark:text-snow"
                                                        >
                                                            {{
                                                                FormattedDate(
                                                                    comment.updated_at
                                                                )
                                                            }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div
                                                    class="md:ms-5 flex-col md:w-2/3"
                                                >
                                                    <p
                                                        class="mb-4 text-base font-light text-oynx dark:text-snow"
                                                    >
                                                        {{ comment.comment }}
                                                    </p>
                                                    <p
                                                        class="mb-2 text-base font-bold text-oynx dark:text-snow capitalize"
                                                    >
                                                        {{ comment.user.name }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="w-full flex justify-center items-center">
                <button @click="loadMoreData">Show More Reviews</button>
            </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div
        v-show="newEventModalVisible"
        class="modal disable-scrollbars pt-12 fixed inset-0 flex justify-center items-center backdrop-blur-sm w-screen h-screen"
    >
        <div
            class="relative p-4 w-full max-h-[90%] disable-scrollbars overflow-y-auto overflow-x-hidden transition-all duration-300 ease-in delay-200"
        >
            <OtherInfo @close="closeModal" :cook="cook"></OtherInfo>
        </div>
    </div>
    <div
        v-show="modalVisible"
        class="modal disable-scrollbars pt-12 fixed inset-0 flex justify-center items-center backdrop-blur-sm w-screen h-screen"
    >
    <Availability  @close="closeAvailable" :cook="cook"> </Availability>
    </div>

    <Footer></Footer>
</template>

<script>
export default {
    inheritAttrs: false,
    props: {
        user: Object,
        cook: Object,
        reviews: Object,
        ratings: String,
        // comments: Strings,
        rating: Object,
        meals: Object, // Prop to receive paginated notifications data from Inertia
    },
    data() {
        return {
            src: "",
            isLoading: true,
            newEventModalVisible: false,
            modalVisible: false,
      
        };
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.handleScroll);
    },

    mounted() {
        this.extractCityAndCountry();
        window.addEventListener("scroll", this.handleScroll);
    },
    created() {
        this.handleScroll();
        // this.fetchData();
    },
    computed: {
        async loadMoreData() {
            if (this.hasMoreData) {
                this.page++;
                await this.fetchData();
            }
        },
        async fetchData() {
            try {
                const response = await axios.get(
                    `/api/rating?page=${this.page}&perPage=${this.perPage}`
                );
                const newComments = response.data.comments.data;

                //     // If there is no new data, set hasMoreData to false
                if (newComments.length === 0) {
                    this.hasMoreData = false;
                }

                // Concatenate new data to the existing meals
                this.comment = [...this.comment, ...newComments];
            } catch (error) {
                //     console.error("Error fetching data:", error);
            }
        },
        firstWord() {
            // Check if $page.props.auth.user.name is defined
            if (this.user.name) {
                // Split the name string into an array of words
                const words = this.user.name.split(" ");

                // Return the first word
                return words[0];
            } else {
                return ""; // Return an empty string if $page.props.auth.user.name is undefined
            }
        },
        timeCooking() {
            const createdAt = new Date(this.user.created_at);
            const now = new Date();
            const diffTime = Math.abs(now - createdAt);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            if (diffDays < 30) {
                return `${diffDays} `;
            } else if (diffDays < 365) {
                const diffMonths = Math.floor(diffDays / 30);
                return `${diffMonths} `;
            } else {
                const diffYears = Math.floor(diffDays / 365);
                return `${diffYears}`;
            }
        },
        CookingDate() {
            const createdAt = new Date(this.user.created_at);
            const now = new Date();
            const diffTime = Math.abs(now - createdAt);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            if (diffDays < 30) {
                return `Days`;
            } else if (diffDays < 365) {
                return `Months`;
            } else {
                return `Years`;
            }
        },
    },
    methods: {
      
        openModal() {
            this.newEventModalVisible = true;
        },
        openAvailable() {
            this.modalVisible = true;
        },

        getStars(num) {
            return Array.from({ length: num }, (_, i) => i + 1);
        },
        FormattedDate(date) {
            const currentDate = new Date();
            const targetDate = new Date(date);

            const diffTime = Math.abs(currentDate - targetDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            const diffWeeks = Math.floor(diffDays / 7);
            const diffMonths =
                currentDate.getMonth() -
                targetDate.getMonth() +
                12 * (currentDate.getFullYear() - targetDate.getFullYear());

            if (diffDays < 7 && diffDays > 1) {
                return `${diffDays} days ago`;
            } else if (diffDays === 1) {
                return "Yesterday";
            } else if (diffDays >= 7 && diffDays < 14) {
                return "1 week ago";
            } else if (diffDays >= 14 && diffDays < 30) {
                return `${diffWeeks} weeks ago`;
            } else {
                return `${targetDate.toLocaleString("default", {
                    month: "long",
                })}, ${targetDate.getFullYear()}`;
            }
        },
        closeModal() {
            // clear everything in the div and close it
            this.newEventModalVisible = false;
        },
        closeAvailable() {
            // clear everything in the div and close it
            this.modalVisible = false;
        },
        getProfilePhotoUrl(profilePhotoPath) {
            if (
                profilePhotoPath.includes("https://lh3.googleusercontent.com")
            ) {
                return profilePhotoPath;
            } else {
                return `/storage/${profilePhotoPath}`;
            }
        },
        extractCityAndCountry(address) {
            if (!address) return { cityAndState: "", country: "" };
            const parts = address.split(", ");
            const cityAndState =
                parts[parts.length - 3] +
                ", " +
                parts[parts.length - 2] +
                ", " +
                parts[parts.length - 1];
            return cityAndState;
        },
        handleScroll() {
            // Adjust the scroll threshold as needed
            const scrollThreshold = 20;
            this.isHeaderFixed = window.scrollY > scrollThreshold;
        },
    },
};
</script>
<style scoped>
button {
    --color: #1b998b;
    font-family: inherit;
    display: inline-block;
    width: 8em;
    height: 2.5em;
    margin: 10px;
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
.fixed {
    position: fixed;
    top: 0;
    width: 100%;
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
