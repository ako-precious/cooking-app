<script setup>
import Navbar from '@/Pages/Cook/Navbar.vue'
import Disclaimer from "@/Pages/MealSchedule/Disclaimer.vue";
</script>

<template>
    <div>
 <Navbar></Navbar>
        <div class="container max-w-3xl m-auto my-10 pb-10 shadow-small">
            <form id="payment-form" @submit.prevent="handleSubmit" class=" py-10">
                <div id="payment-element">
                    <!-- Elements will create form elements here -->
                </div>
                <button id="submit" class=" btn2span group float-left w-full ">
                    <span class="next-span"> Submit Details </span>
                    <span class="with-span"> Make Payment </span>
                </button>
                <div id="error-message">
                    <!-- Display error message to your customers here -->
                </div>
            </form>
        </div>
    </div>
    
    <div
    class="modal disable-scrollbars overflow-y-auto overflow-x-hidden pt-16 fixed top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 z-[100] flex justify-center items-center backdrop-blur-sm w-full h-full"
   
    >   <div
            class="relative p-4 w-full max-w-md max-h-full transition-all duration-300 ease-in delay-200"
        >
        <Disclaimer></Disclaimer>
</div>
</div>
</template>

<script>
import { loadStripe } from "@stripe/stripe-js";

export default {
    data() {
        return {
            stripe: null,
            elements: null,
            clientSecret: new URLSearchParams(window.location.search).get(
                "client_secret"
            ),
        };
    },
    async mounted() {
        this.stripe = await loadStripe(
            "pk_test_51OjplDL2JFKeogL4wsxVYfkG8zCegW66jPKapqF6QtnmakopSVRHFn2YE4tuQK4ZhZROFhJ9iTohD5dZ2wlS1H9x00zqkwyGg2"
        );
        const options = {
            clientSecret: this.clientSecret,
            appearance: { theme: "stripe" },
        };
        this.elements = this.stripe.elements(options);
        const paymentElement = this.elements.create("payment");
        paymentElement.mount("#payment-element");
    },
    methods: {
        async handleSubmit() {
            const { error } = await this.stripe.confirmPayment({
                elements: this.elements,
                confirmParams: {
                    return_url: route("checkout.return"),
                },
            });
            if (error) {
                console.error(error);
            }
        },
    },
};
</script>
<!-- <script>
import { loadStripe } from "@stripe/stripe-js";

export default {
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
        console.log(this.clientSecret);
    this.stripe = await loadStripe('pk_test_51OjplDL2JFKeogL4wsxVYfkG8zCegW66jPKapqF6QtnmakopSVRHFn2YE4tuQK4ZhZROFhJ9iTohD5dZ2wlS1H9x00zqkwyGg2');
    if (!this.stripe) {
      throw new Error('Stripe could not be initialized.');
    }

    const appearance = { theme: 'stripe' };
    const clientSecret = this.clientSecret;
    this.elements = this.stripe.elements({ clientSecret, appearance });
    const cardElement = this.elements.create('card');
    cardElement.mount('#payment-element');
    
        // if (this.clientSecret) {
        //     this.stripe
        //         .retrievePaymentIntent(this.clientSecret)
        //         .then(({ paymentIntent }) => {
        //             const message = document.querySelector("#message");
        //             switch (paymentIntent.status) {
        //                 case "succeeded":
        //                     message.innerText = "Success! Payment received.";
        //                     break;
        //                 case "processing":
        //                     message.innerText =
        //                         "Payment processing. We'll update you when payment is received.";
        //                     break;
        //                 case "requires_payment_method":
        //                     message.innerText =
        //                         "Payment failed. Please try another payment method.";
        //                     break;
        //                 default:
        //                     message.innerText = "Something went wrong.";
        //                     break;
        //             }
        //         });
        // }
    },
    // methods: {
    //     async handleSubmit() {
    //         const { error } = await this.stripe.confirmPayment({
    //             elements: this.elements,
    //             confirmParams: {
    //                 return_url: "https://example.com/order/123/complete",
    //             },
    //         });

    //         if (error) {
    //             const messageContainer =
    //                 document.querySelector("#error-message");
    //             messageContainer.textContent = error.message;
    //         }
    //     },
    // },
};
</script> -->
