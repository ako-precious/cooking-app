
<script setup>
 import CloseButton from '@/Components/CloseButton.vue'
</script>
<template>
  
    <!--  -->
    <div
        id="defaultModal"
        tabindex="-1"
        aria-hidden="true"
        class="overflow-y-auto overflow-x-hidden flex justify-center items-center fixed top-0 right-0 left-0 w-full md:inset-0 h-modal md:h-full z-990"
    >
        <div class="relative p-4 w-full m-auto max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-snow rounded-lg shadow dark:bg-oynx">
                <!-- Modal header -->
                <div
                    class="flex justify-between items-center p-4 rounded-t border-b dark:border-gray-600"
                >
                    <h3
                        class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white capitalize"
                    >
                        Select available days
                    </h3>

                   <CloseButton  @click="$emit('close')"/>
                </div>
                <!-- Modal body -->
                <div class="h-60 overflow-y-auto py-4 space-y-6">
                   <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4 lg:gap-8 lg:px-8">
        <div
            class="col-span-1 w-full max-w-full py-2"
            v-for="day in days"
            :key="day"
        >
            <div
                :class="{
                    'border-persian border-2': selectedDiv.includes(day),
                }"
                class="flex min-w-0 break-words w-full py-4 shadow-reverse group rounded-2xl bg-clip-border cursor-pointer"
                @click="toggleDay(day)"
            >
                <div
                    class="flex lg:flex-col justify-center flex-wrap w-full p-4 mb-0 list-none rounded-xl"
                >
                    <div class="pt-2 w-full">
                        <p
                            class="font-semibold text-center transition-colors ease-in-out rounded-lg group-action-text"
                        >
                            <span class="lg:text-xl leading-normal">{{
                                day
                            }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        class="flex items-center  justify-center rounded-b"
    >
        <button @click="sendData"
            data-modal-toggle="defaultModal"
            type="button"
            class="text-white font-medium rounded-lg text-sm px-5 text-center flex items-center justify-center hover:scale-[1.02] transition-transform"
        >
            Save
        </button>
    </div>
    </div>
                <!-- Modal footer -->
            </div>
        </div>
    </div>
    
</template>

<script>
export default {
    inheritAttrs: false,
    props: {    
            cook: Object
        },
    data() {
        return {
            selectedDiv:  this.cook.availability || [], // Array to hold selected days
            days: [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday",
                "Saturday",
                "Sunday",
            ], // Array of days
        };
    },

    methods: {
        toggleDay(day) {
            // Toggle the selection of a day
            if (this.selectedDiv.includes(day)) {
                this.selectedDiv = this.selectedDiv.filter((d) => d !== day);
            } else {
                this.selectedDiv.push(day);
            }
            // this.sendData(); // Send the updated selection to the backend
        },
        sendData() {
            // Send selected days to the backend
            // Here, you would typically make an API call to send the data
            // For example, using axios:
            // axios.post('/your-backend-endpoint', { selectedDays: this.selectedDiv });
            axios
                    .put("/api/availability/" + this.cook.id, { selectedDays: this.selectedDiv })
                    .then((response) => {
                        console.log(response.data);
                        this.$inertia.visit(`/user-profile/${this.cook.user_id}`);
                    })
                    .catch((error) => {
                        // Handle error
                        // console.error("Error saving data:", error);
                    });

            console.log("Selected days:", this.selectedDiv); // For demonstration
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
