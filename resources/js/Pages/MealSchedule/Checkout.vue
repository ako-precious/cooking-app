<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";

import Navbar from '@/Pages/Cook/Navbar.vue'
</script>

<template>
    <div>
        <Navbar></Navbar>
        <div class="flex flex-col justify-center items-center min-h-screen  text-oynx dark:text-snow"> 
            <div class="shadow-reverse rounded-lg p-6 max-w-md w-full bg-snow dark:bg-oynx">
                <h1 class="text-2xl font-bold mb-6 text-center">Payment Initialization</h1>
                <InputError v-if="error">{{ error }}</InputError>
                <div class="flex justify-between mb-4">
                    <div class="flex items-center justify-center m-auto">
                        <img v-if="firstPhoto"
                            :src="getPhoto(firstPhoto.meal_photo_path)"
                            alt="Product Image"
                            class="mr-6 h-[130px] rounded-lg object-cover"
                        />
                        <img v-else src="/images/imagenotfound.png" alt=""  class="mr-6 h-[130px]">
                        <div>
                        </div>
                    </div>
                </div>
                <hr class="my-4" />
                <div class="flex justify-between items-center">
                    <span class="font-bold">Meal Name</span>
                    <h2 class="font-bold capitalize">{{ meal.name }}</h2>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <span class="font-bold">Meal Price <font-awesome-icon icon="fa-solid fa-circle-info" title="The meal price multiplies by the quantity" /></span>
                    <span class="font-bold">${{ (mealSchedule.prices.price * this.mealSchedule.portion).toFixed(2) }}</span>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <span>Meal Quantity </span>
                    <span> {{ mealSchedule.portion }} </span>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <span>Meal Size</span>
                    <span> {{ mealSchedule.prices.size}}  {{mealSchedule.prices.size === mealSchedule.prices.unit? "" : mealSchedule.prices.unit}}(s) </span>
                </div>
                <div class="flex justify-between items-center mt-4">
                    <span>Payment Charges <font-awesome-icon icon="fa-solid fa-circle-info" title="We charge 7% tranfer fee" /></span>
                    <span>$ {{ transferFee }}  </span>
                </div>
                <hr class="my-4" />
                <div class="flex justify-between items-center">
                    <span class="font-bold">Total:</span>
                    <span class="font-bold">${{ total}} </span>
                </div>
                <div class="flex justify-center mt-6">
                    <PrimaryButton @click="charge">Proceed to Pay</PrimaryButton>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        mealSchedule: { type: Object, required: true },
        meal: { type: Object, required: true },
        firstPhoto: { type: Object, default: null },
    },

    data() {
        return { error: null };
    },

    computed: {
        price() {
            return parseFloat(this.mealSchedule.prices.price) || 0;
            
        },
        portion() {
            return parseInt(this.mealSchedule.portion) || 1;
        },
        transferFee() {
            return (this.price * this.portion * 0.07).toFixed(2);
            
        },
        total() {
            return ((this.price * this.portion) + parseFloat(this.transferFee)).toFixed(2);
        },
        photoUrl() {
            if (this.firstPhoto?.meal_photo_path) {
                return `/storage/${this.firstPhoto.meal_photo_path}`.replace("/public", "");
            }
            return "/images/imagenotfound.png";
        }
    },

    methods: {
        async charge() {
            try {
                const response = await axios.post("/checkout", {
                    schedule_id: this.mealSchedule.id,
                    amount: this.total,
                });

                const { client_secret } = response.data;
                this.$inertia.visit(`/payment?client_secret=${client_secret}`);
            } catch (error) {
                this.error = "Error processing the payment";
                console.error("Payment error:", error);
            }
        }
    }
};
</script>


<!-- <script>
import axios from "axios";
export default {
    inheritAttrs: false,
    props: {
        mealSchedule: Object,
        meal: Object,
        firstPhoto: Object,
    },
    data() {
        return {
            error: null,
        };
    },
    mounted() {
        this.TransferFee();
        this.Total();
        this.getPhoto();
    },
    //   created(){
    //     console.log(this.charge());
    //   },
    methods: {
        async charge() {
            const total = (
                parseFloat(this.mealSchedule.prices.price) +
                (3 / 100) * parseFloat(this.mealSchedule.prices.price) * this.mealSchedule.portion 
            ).toFixed(2);
            await axios
                .post("/checkout", {
                    schedule_id: this.mealSchedule.id,
                    amount: total,
                })
                .then((response) => {
                    // console.log(response);
                    const client_secret = response.data.client_secret
                    const token = response.data.token
                //    console.log(client_secret);
                    this.$inertia.visit(
                            `/payment?client_secret=${client_secret}`
                        );
                })
                .catch((error) => {
                    this.error = 'Error processing the payment';
                    console.error("Error fetching data:", error);
                });
        },
        TransferFee(price) {
            return ((7 / 100) * parseFloat(price) * this.mealSchedule.portion).toFixed(2) ;
        },
        Total(price) {
            const total = (7 / 100) * parseFloat(price) * this.mealSchedule.portion ;
            return (parseFloat(price) + total).toFixed(2);
        },

        getPhoto(src) {
            const photo = `/storage/${src}`.replace("/public", "");
            return photo;
        },
    },
};
</script> -->

<style>
.error {
    color: red;
}
.success {
    color: green;
}
</style>
