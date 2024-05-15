<template>
    <form id="payment-form">
        <div id="payment-element">
            <!-- Stripe will create form elements here -->
        </div>
        <button type="submit" @click="handleSubmit">Pay via Stripe</button>
    </form>
    {{ mealSchedule }}
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
            token: "",
            stripe: "",
            elements: "",
        };
    },
    mounted() {
        console.log(this.mealSchedule);
    },
    methods: {
        async handleSubmit(e) {
            e.preventDefault();

            const { error } = await stripe.value.confirmCardPayment(
                token.value,
                {
                    payment_method: {
                        card: elements.value.getElement("card"),
                    },
                }
            );

            if (error) {
                axios.post("PAYMENT_FAILURE_API", {
                    token: token.value,
                    code: error.code,
                    description: error.message,
                });
            } else {
                axios.post("PAYMENT_SUCCESS_API", {
                    token: token.value,
                });
            }
        },
    },
};
</script>
