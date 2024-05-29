<script setup>
import axios from "axios";
import TextInput from "@/Components/TextInput.vue";
</script>
<template>
    <div
       
        class="flex py-6 flex-col flex-auto flex-shrink-0 rounded-2xl h-full"
    >
        <div class="flex flex-col h-full overflow-x-auto simple">
            <div class="flex flex-col h-full">
                <div class="grid grid-cols-12 gap-y-2">
                    <div class="col-start-4 col-end-13 p-3 rounded-lg">
                        <div
                            class="flex items-center justify-start flex-row-reverse"
                        >
                            <div
                                class="relative mr-3 text-sm bg-persian py-2 px-4 shadow rounded-t-[2rem] rounded-l-[2rem]"
                            >
                                <div>
                                    Lorem ipsum dolor sit, amet consectetur
                                    adipisicing. ?
                                </div>
                                <div
                                    class="absolute text-xs bottom-0 right-0 -mb-5 mr-2 text-gray-500"
                                >
                                    Seen
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-start-1 col-end-9 p-3 rounded-lg">
                        <div class="flex flex-row items-center">
                            <div
                                class="relative ml-3 text-sm text-oynx dark:text-snow bg-snow/40 dark:bg-oynx/40 py-2 px-4 shadow rounded-t-[2rem] rounded-r-[2rem]"
                            >
                                <div>
                                    Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit. Perspiciatis, in.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-for="message in messages" :key="message.id">
            <strong>{{ message.user_id }}:</strong> {{ message.message }}
        </div>
        <div
            class="flex flex-row items-center h-16 rounded-b-xl bg-transparent w-full p-3"
        >
            <div class="flex-grow ml-4">
                <div class="relative w-full">
                    <!-- <input
                                        type="text"
                                        class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10"
                                    /> -->
                    <TextInput
                        class="w-full relative"
                        v-model="newMessage"
                        @keyup.enter="sendMessage"
                    />
                </div>
            </div>
            <div class="ml-4">
                <button
                    @click="sendMessage"
                    class="flex items-center justify-center rounded-xl text-white flex-shrink-0"
                >
                    <span class="">
                        <svg
                            class="w-6 h-6 transform rotate-90 text-polynesian dark:text-lighred hover:rotate-45 hover:text-persian"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                            ></path>
                        </svg>
                    </span>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        order: Object,
    },
    data() {
        return {
            messages: [],
            newMessage: "",
        };
    },
    mounted() {
        this.fetchMessages();
        Echo.channel("chat").listen("MessageSent", (e) => {
            this.messages.push(e.chat);
        });
    },
    methods: {
        fetchMessages() {
            axios.get("/messages").then((response) => {
                this.messages = response.data;
            });
        },
        sendMessage() {
            axios
                .post("/messages", {
                    user: this.$page.props.auth.user.id,
                    meal_schedule_id: this.order.id, // Replace with the actual user
                    message: this.newMessage,
                })
                .then((response) => {
                    this.newMessage = "";
                });
        },
    },
};
</script>
