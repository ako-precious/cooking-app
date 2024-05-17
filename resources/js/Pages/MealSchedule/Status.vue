<script setup>
import Navbar from '@/Pages/Cook/Navbar.vue'
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <div>
 <Navbar></Navbar>

 <div class="flex py-10 justify-center flex-col items-center">

     <p onclick="updateStatus()" id="message"></p>
     <p>Track your order <Link  :href="`/meal-schedule`"> herre {{ mealSchedule }} </Link></p>
 </div>

    </div>
</template>

<script>
import axios from "axios";
export default {
    inheritAttrs: false,
    props: {
        mealSchedule: Object,
    },
    data() {
        return {
            stripe: null,
            elements: null,
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
                message.innerText = ` Payment Successful!

Order number: 123456
Items: Product A, Product B
Total: $100.00

`;

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
};
</script>
