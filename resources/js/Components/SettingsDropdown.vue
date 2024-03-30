<script setup>
import { Head, Link, router } from "@inertiajs/vue3";

import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
const logout = () => {
    router.post(route("logout"));
};
</script>

<template>
    <!-- Settings Dropdown -->
    <div
        class="ml-2 lg:mr-4 relative text-oynx active:text-persian hover:text-polynesian dark:text-snow dark:active:text-persian dark:hover:text-lighred rounded-full bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-sm hover:-shadow-snow-sm focus:shadow-none active:shadow-none hover:border-polynesian dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] dark:shadow-oynx-sm hover:dark:-shadow-oynx-sm active:dark:shadow-none z-20 transition-all duration-250 ease-in"
    >
        <Dropdown align="right" width="48">
            <template #trigger>
                <button
                    v-if="$page.props.jetstream.managesProfilePhotos"
                    class="flex w-11 h-11 relative text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                >
                    <img
                        class="h-full w-full rounded-full object-cover"
                        :src="$page.props.auth.user.profile_photo_url"
                        :alt="$page.props.auth.user.name"
                    />
                    <div v-if="notifications" class="absolute top-[20%] right-[10%] ">
        
        <div
        class="bg-lighred w-[8px] h-[8px]  rounded-full animate-ping group-hover:animate-none "><p class="opacity-0">r</p></div>
      </div>
                </button>

                <span v-else class="inline-flex rounded-md">
                    <button
                        type="button"
                        class="inline-flex items-center px-3 py-3 border border-transparent text-sm leading-4 font-medium rounded-full transition ease-in-out duration-150"
                    >
                        {{ truncatedIng($page.props.auth.user.name) }}
                        <font-awesome-icon
                            icon="caret-down"
                            class="h-3 lg:h-4 ml-2 svg-inline--fa fa-user fa-w-14 fa-9x"
                        />
                    </button>
                </span>
            </template>

            <template #content class="bg-snow dark:bg-oynx">
                <div
                    class="origin-top-right absolute right-0 mt-2 w-48 delay-75 rounded-md border-snow ring-1 bg-gradient-to-br from-[#e3dedf] to-[#ffffff] -shadow-snow-sm hover:shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] dark:-shadow-oynx-sm hover:dark:shadow-oynx-sm z-20 transition-all duration-250 ease-in dark:border-oynx"
                >
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-600">
                        Manage Account
                    </div>

                    <DropdownLink
                        :href="route('profile.show')"
                        class="flex w-full items-center rounded-md px-4 py-2 text-sm text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                    ><font-awesome-icon icon="user" class="mr-2" />
                        Profile 
                    </DropdownLink>
                    <DropdownLink
                        :href="'profile.show'"
                        class="relative flex items-center rounded-md px-4 py-2 text-sm text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                    >
                    <font-awesome-icon icon="bell" class="mr-2" />
                        Notification
                    </DropdownLink>

                    <DropdownLink
                        v-if="$page.props.jetstream.hasApiFeatures"
                        :href="route('api-tokens.index')"
                    >
                        API Tokens
                    </DropdownLink>

                    <div
                        class="border-t border-gray-200 dark:border-gray-600"
                    />

                    <!-- Authentication -->
                    <form @submit.prevent="logout">
                        <DropdownLink
                            as="button"
                            class="flex items-center rounded-md px-4 py-2 text-sm text-oynx hover:text-polynesian dark:text-snow dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                        >
                        <font-awesome-icon
                            icon="right-from-bracket"
                            class="mr-2"
                        />
                            Log Out
                        </DropdownLink>
                    </form>
                    <!-- Add the toggle bo ttuns later -->
                </div>
            </template>
        </Dropdown>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            notifications: "",
        };
    },
    created() {
        this.checkNotification();
    },
    methods: {
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
