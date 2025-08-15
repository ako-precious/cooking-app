<script setup>
import Navbar from "@/Pages/Cook/Navbar.vue";
import { Head, Link } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
defineProps(["order","mealSchedule"]);
</script>

<template>
    <Head title="Payment Receipt" />
    <div>
        <Navbar></Navbar>
        <!-- component -->
        <div class="flex h-screen w-full items-center justify-center">
            <div
                class=" rounded shadow-small text-oynx dark:text-snow px-6 pt-8 shadow-lg w-full max-w-sm bg-snow dark:bg-oynx"
            >
                <div class="flex justify-center">
                    <ApplicationMark class=""></ApplicationMark>
                </div>
                <div class="flex flex-col pt-2 justify-center items-center gap-2">
                    <h4 class="font-bold">Mymealni</h4>
                    <p onclick="updateStatus()" id="message"></p>
                </div>
                <div class="flex flex-col gap-3 border-b py-6 ">
                    <p class="flex justify-between">
                        <span class=" font-semibold">Receipt No.:</span>
                        <span># {{ mealSchedule.id }}</span>
                    </p>
                    <p class="flex justify-between">
                        <span class=" font-semibold">Meal Time:</span>
                        <span>{{ mealSchedule.meal_time }}</span>
                    </p>
                    <p class="flex justify-between">
                        <span class=" font-semibold">Order Time:</span>
                        <span>{{   FormattedDate(mealSchedule.created_at) }}</span>
                    </p>
                    <p class="flex justify-between capitalize">
                        <span class=" font-semibold">Cook:</span>
                        <!-- <span>{{ mealSchedule.meal.cook_id }}</span> -->
                        <span>{{ getCook(mealSchedule.meal.id) }}</span>
                    </p>
                    <p class="flex justify-between capitalize">
                        <span class=" font-semibold">Customer:</span>
                        <span>{{ mealSchedule.user.name }}</span>
                    </p>
                    <p class=" ">
                       Click <Link :href="`/cook/order/${mealSchedule.id}`" class="text-persian"> here </Link> to view order status
                    </p>
                </div>
                <div class="flex flex-col gap-3 pb-6 pt-2 ">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="flex">
                                <th class="w-full py-2">Product</th>
                                <th class="min-w-[44px] py-2">QTY</th>
                                <th class="min-w-[44px] py-2">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="flex">
                                <td class="flex-1 py-1 capitalize">{{ mealSchedule.meal.name }}</td>                             
                                <td class="min-w-[44px]">{{ mealSchedule.portion }}</td>
                                <td class="min-w-[44px]">$ {{ order.total_price }}</td>
                            </tr>
                           
                        </tbody>
                    </table>
                    <div class="border-b border border-dashed"></div>
                    <div
                        class="py-4 justify-center items-center flex flex-col gap-2"
                    >
                        <p class="flex gap-2 items-center">
                           <font-awesome-icon icon="fa-solid fa-envelope" class="px-2 "/>
                           <span>messages@mymealni.com </span> 
                        </p>
                        <p class="flex gap-2 items-center">
                            <font-awesome-icon icon="fa-solid fa-phone " class="px-2" />
                            <span> +1 7052793660 </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    inheritAttrs: false,

    data() {
        return {
            stripe: null,
            elements: null,
            user_name: "",
            clientSecret: new URLSearchParams(window.location.search).get(
                "payment_intent_client_secret"
            ),
        };
    },
    async mounted() {
      
        const stripe = Stripe(
            "pk_test_51OjplDL2JFKeogL4wsxVYfkG8zCegW66jPKapqF6QtnmakopSVRHFn2YE4tuQK4ZhZROFhJ9iTohD5dZ2wlS1H9x00zqkwyGg2"
        );

        // Retrieve the "payment_intent_client_secret" query parameter from the return_url
        const clientSecret = this.clientSecret;

        // Retrieve the PaymentIntent
        const { paymentIntent } = await stripe.retrievePaymentIntent(
            clientSecret
        );
        const message = document.querySelector("#message");

        // Display payment status to the customer
        switch (paymentIntent.status) {
            case "succeeded":
                message.innerText = ` Payment Successful!`

                break;
            case "processing":
                message.innerText =
                    "Payment processing. We'll update you when payment is received.";
                break;
            case "requires_payment_method":
                message.innerText =
                    "Payment failed. Please try another payment method.";
                // Optionally redirect back to payment page
                break;
            default:
                message.innerText = "Something went wrong.";
                break;
        }
     
    },
   
    methods:{
      FormattedDate(timestamp) {
            const date = new Date(timestamp);
            const formattedDate = `${date.getFullYear()}-${(date.getMonth() + 1)
                .toString()
                .padStart(2, "0")}-${date
                .getDate()
                .toString()
                .padStart(2, "0")}`;
            return formattedDate;
        },
      Total(price) {
            const total = (7 / 100) * parseFloat(price);
            return (parseFloat(price) + total).toFixed(2);
        },
        getCook(id) {
            axios
                .get("/meal/" + id)
                .then((response) => {
                    // console.log("Data sent successfully:", response.data.meal);
                    this.user_name = response.data.meal.user.name;
                })
                .catch((error) => {
                    console.error("Error sending data:", error);
                });
            return this.user_name;
        },
    }

};
</script>
