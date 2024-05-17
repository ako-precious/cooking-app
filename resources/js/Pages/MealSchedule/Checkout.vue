<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
</script>
<template>
    <div class="flex flex-col justify-center items-center min-h-screen">
        <div class="shadow-reverse rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6">Payment Initialization</h1>
            <InputError v-if="error">{{ error }}</InputError>
            <div class="flex justify-between mb-4">
                <div class="flex items-center">
                    <img
                        :src="getPhoto(firstPhoto.meal_photo_path)"
                        alt="Product Image"
                        class="mr-6 h-[130px]"
                    />
                    <div>
                        <h2 class="font-bold capitalize">{{ meal.name }}</h2>
                        <span class="font-bold">${{ meal.price }}</span>
                    </div>
                </div>
            </div>
            <hr class="my-4" />
            <div class="flex justify-between items-center">
                <span class="font-bold">Subtotal:</span>
                <span class="font-bold">${{ meal.price }}</span>
            </div>
            <div class="flex justify-between items-center mt-4">
                <span>Payment Charges:</span>
                <span>$ {{ TransferFee(meal.price) }} </span>
            </div>
            <hr class="my-4" />
            <div class="flex justify-between items-center">
                <span class="font-bold">Total:</span>
                <span class="font-bold">${{ Total(meal.price) }} </span>
            </div>
            <div class="flex justify-center mt-6">
                <PrimaryButton @click="charge">Proceed to Pay</PrimaryButton>
            </div>
        </div>
    </div>
</template>

<script>
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
                parseFloat(this.meal.price) +
                (3 / 100) * parseFloat(this.meal.price)
            ).toFixed(2);
            await axios
                .post("/checkout", {
                    schedule_id: this.mealSchedule.id,
                    amount: total,
                })
                .then((response) => {
                    console.log(response);
                    const client_secret = response.data.client_secret
                    const token = response.data.token
                   console.log(client_secret);
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
            return (3 / 100) * price;
        },
        Total(price) {
            const total = (3 / 100) * parseFloat(price);
            return (parseFloat(price) + total).toFixed(2);
        },

        getPhoto(src) {
            const photo = `/storage/${src}`.replace("/public", "");
            return photo;
        },
    },
};
</script>

<style>
.error {
    color: red;
}
.success {
    color: green;
}
</style>
