<template>
    <div>
        <p onclick="updateStatus()" id="message"></p>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            stripe: null,
            elements: null,
            clientSecret: new URLSearchParams(window.location.search).get(
            "payment_intent_client_secret")
        };
    },
    async mounted() {
        const stripe = Stripe(
            "pk_test_51OjplDL2JFKeogL4wsxVYfkG8zCegW66jPKapqF6QtnmakopSVRHFn2YE4tuQK4ZhZROFhJ9iTohD5dZ2wlS1H9x00zqkwyGg2"
        );

        // Retrieve the "payment_intent_client_secret" query parameter from the return_url
        const clientSecret = this.clientSecret

        // Retrieve the PaymentIntent
        const { paymentIntent } = await stripe.retrievePaymentIntent(
            clientSecret
        );
        const message = document.querySelector("#message");

        // Display payment status to the customer
        switch (paymentIntent.status) {
            case "succeeded":
                message.innerText = "Success! Payment received.";
               this.updateStatus()
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
    methods: {
        updateStatus() {
            axios
                .put("/payment/processed", {
                    client_secret: this.clientSecret,
                })
                .then((response) => {
                    console.log(response);
                })
                .catch((error) => {
                    console.error("Error fetching data:", error);
                });
        },
    },
};
</script>
