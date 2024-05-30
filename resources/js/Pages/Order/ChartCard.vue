<script setup>
import axios from "axios";
import TextInput from "@/Components/TextInput.vue";
</script>
<template>
    <div
        class="relative flex pt-6 flex-col flex-auto flex-shrink-0 rounded-2xl h-full"
    >
        <div
            class="h-[20rem] scrollDiv overflow-y-scroll flex flex-col overflow-x-auto simple"
            id="scrollDiv"
        >
            <div class="flex flex-col h-full">
                <div v-for="(messages, date) in groupedMessages" :key="date">
                    <div class="text-sm text-center font-bold mt-4">
                        {{ date }}
                    </div>
                    <div
                        v-for="message in messages"
                        :key="message.id"
                        class="grid grid-cols-12 gap-y-2"
                    >
                        <div
                            v-if="$page.props.auth.user.id == message.user_id"
                            class="col-start-4 col-end-13 py-3.5 px-2 rounded-lg"
                        >
                            <div
                                class="flex items-center justify-start flex-row-reverse"
                            >
                                <div
                                    class="relative mr-3 text-sm bg-persian py-2 px-4 shadow rounded-t-[2rem] rounded-l-[2rem]"
                                >
                                    <div>
                                        {{ message.message }}
                                    </div>
                                    <div
                                        class="absolute text-xxs bottom-0 right-0 -mb-5 mr-2 text-gray-500"
                                    >
                                        {{ formatDate(message.created_at) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            v-else
                            class="col-start-1 col-end-9 py-3.5 px-2 rounded-lg"
                        >
                            <div class="flex flex-row items-center">
                                <div
                                    class="relative ml-3 text-sm text-oynx dark:text-snow bg-snow/40 dark:bg-oynx/40 py-2 px-4 shadow rounded-t-[2rem] rounded-r-[2rem]"
                                >
                                    <div>
                                        {{ message.message }}
                                    </div>
                                    <div
                                        class="absolute text-xxs bottom-0 left-0 -mb-5 mr-2 text-gray-500"
                                    >
                                        {{ formatDate(message.created_at) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="sticky flex flex-row items-center h-16 rounded-b-xl bg-snow dark:bg-oynx w-full py-4 px-3"
        >
            <div class="flex-grow ml-2">
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
            scrollDiv: document.getElementById("scroll"),
        };
    },

    mounted() {
        this.fetchMessages();
        this.connect();
        this.scrollToBottom();
    },
    computed: {
        groupedMessages() {
            return this.messages.reduce((acc, message) => {
                const dateKey = this.formattedDay(message.created_at);
                if (!acc[dateKey]) {
                    acc[dateKey] = [];
                }
                acc[dateKey].push(message);
                return acc;
            }, {});
        },
    },
    watch: {
        currentOrder(val, oldVal) {
            if (oldVal.id) {
                this.disconnect(oldVal);
            }
            this.connect();
        },
    },

    methods: {
        scrollToBottom() {
            this.$nextTick(() => {
                const scrollDiv = document.getElementById("scrollDiv");
                if (scrollDiv) {
                    scrollDiv.scrollTop = scrollDiv.scrollHeight;
                }
            });
        },
        connect() {
            this.scrollToBottom();
            if (this.order.id) {
                let vm = this;
                this.fetchMessages();
                window.Echo.private("chat." + this.order.id).listen(
                    "MessageSent",
                    (e) => {
                        vm.fetchMessages();
                        this.messages.push(e.chat);
                    }
                );
            }
        },
        disconnect(order) {
            window.echo.leave("chat." + order.id);
        },
        fetchMessages() {
            this.scrollToBottom();
            axios.get("/messages/" + this.order.id).then((response) => {
                this.messages = response.data;
            });
        },
        sendMessage() {
            if (this.newMessage == " " || this.newMessage == null) {
                return;
            } else {
                axios
                    .post("/messages", {
                        user: this.$page.props.auth.user.id,
                        meal_schedule_id: this.order.id, // Replace with the actual user
                        message: this.newMessage,
                    })
                    .then((response) => {
                        this.messages = response.data;
                        this.newMessage = "";
                        // Scroll to the bottom of the div with ID 'scroll'
                        this.scrollToBottom();
                    });
            }
        },
       
        formatDate(datetime) {
            const date = new Date(datetime);

            // Extracting parts of the date and time
            const hours = String(date.getHours()).padStart(2, "0");
            const minutes = String(date.getMinutes()).padStart(2, "0");

            // Formatting the date and time as "13:49 30/05/2024 GMT+05:30"
            return `${hours}:${minutes}`;
        },
        formattedDay(datetime) {
            const date = new Date(datetime);
            // Extracting parts of the date and time
            const day = String(date.getDate()).padStart(2, "0");
            const month = String(date.getMonth() + 1).padStart(2, "0"); // Months are 0-indexed
            const year = date.getFullYear();
            // Formatting the date and time as "13:49 30/05/2024"
            return `${day}/${month}/${year}`;
        },
    },
};
</script>

<style scoped>
.simple::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}
.simple::-webkit-scrollbar-track {
    border-radius: 10px;
    background: rgba(0, 0, 0, 0.1);
}
.simple::-webkit-scrollbar-thumb {
    border-radius: 10px;
    background: rgba(0, 0, 0, 0.2);
}
.simple::-webkit-scrollbar-thumb:hover {
    background: rgba(0, 0, 0, 0.4);
}
.simple::-webkit-scrollbar-thumb:active {
    background: rgba(0, 0, 0, 0.8);
}
</style>
