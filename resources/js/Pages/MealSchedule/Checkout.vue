<template>
  <form id="payment-form">
      <div id="payment-element">
          <!-- Stripe will create form elements here -->
      </div>
      <button type="submit" @click="handleSubmit">Pay via Stripe</button>
  </form>
</template>
<script setup>
import { ref, onMounted } from "vue"
import axios from "axios";
defineProps({
    mealSchedule: Object,
}); 
const token = ref(null)
const stripe = ref(null)
const elements = ref(null)

onMounted(() => {
    // const mealId = this.mealSchedule.id;
    axios.post(`/checkout?schedule_id=${30}`).then(response => {
        token.value = response.data.clientSecret; // Assuming `clientSecret` is returned from server
        stripe.value = Stripe('pk_test_51OjplDL2JFKeogL4wsxVYfkG8zCegW66jPKapqF6QtnmakopSVRHFn2YE4tuQK4ZhZROFhJ9iTohD5dZ2wlS1H9x00zqkwyGg2'); // Replace with your publishable key
        const options = {
            clientSecret: token.value,
        }

        elements.value = stripe.value.elements(options);
        const paymentElement = elements.value.create('card');
        paymentElement.mount('#payment-element');
    }).catch(error => {
        console.error(error);
    })
})

const handleSubmit = async (e) => {
    e.preventDefault();

    const { error } = await stripe.value.confirmCardPayment(token.value, {
        payment_method: {
            card: elements.value.getElement('card'),
        }
    });

    if (error) {
        axios.post("PAYMENT_FAILURE_API", {
            token: token.value,
            code: error.code,
            description: error.message,
        })
    } else {
        axios.post("PAYMENT_SUCCESS_API", {
            token: token.value,
        })
    }
}
</script>

<!-- <script setup>
import { ref, onMounted } from "vue"
import axios from "axios";
 defineProps({
    mealSchedule: Object,
}); 
const token = ref(null)
const stripe = ref(null)
const elements = ref(null)

onMounted(() => {
  const mealId = mealSchedule.id;
  axios.post(`/checkout?schedule_id=${mealId}`).then(response => {
      token.value = response.token // Use to identify the payment
      stripe.value = Stripe(STRIPE_PUBLISHABLE_KEY);
      const options = {
          clientSecret: response.clientSecret,
      }

      elements.value = stripe.value.elements(options);
      const paymentElement = elements.value.create('payment');
      paymentElement.mount('#payment-element');
  }).catch(error => {
      // throw error
  })
})

const handleSubmit = async (e) => {
  e.preventDefault();

  const { error } = await stripe.value.confirmPayment({
      elements: elements.value,
      redirect: "if_required"
  });

  if (error === undefined) {
      axios.post("PAYMENT_SUCCESS_API", {
          token: token.value,
      })
  } else {
      axios.post("PAYMENT_FAILURE_API", {
          token: token.value,
          code: error.code,
          description: error.message,
      })
  }
}
</script> -->
<script>
// export default {
 
//   mounted() {
//     this.initializeStripeCheckout();
//   },
//   methods: {
//     async initializeStripeCheckout() {
//       const mealId = this.mealSchedule.id;
      
//       // Initiate the payment session and get client secret
//       // const response = await fetch(, {
//       //   method: "POST",
//       // });
//       const { clientSecret } = await response.json();
      
//       // Initialize Stripe
//       const stripe = Stripe('pk_test_51OjplDL2JFKeogL4wsxVYfkG8zCegW66jPKapqF6QtnmakopSVRHFn2YE4tuQK4ZhZROFhJ9iTohD5dZ2wlS1H9x00zqkwyGg2');
      
//       // Create a checkout instance
//       const checkout = await stripe.initEmbeddedCheckout({
//         clientSecret,
//       });
      
//       // Mount Checkout form
//       checkout.mount('#checkout');
      
//       // Listen for payment success
//       checkout.on('paymentSuccess', async () => {
//         // Wait for meal status change to "accept" within 2 hours
//         const isAccepted = await this.waitForAcceptance(mealId);
        
//         if (isAccepted) {
//           // Payment and meal acceptance successful
//           console.log("Payment successful and meal accepted.");
//         } else {
//           // Meal acceptance failed within the timeframe
//           console.log("Meal acceptance failed within 2 hours.");
//         }
//       });
//     },
//     async waitForAcceptance(mealId) { 
//       // Poll the backend to check meal status every few seconds
//       const start = Date.now();
//       while (Date.now() - start < 2 * 60 * 60 * 1000) { // 2 hours
//         const response = await fetch(`/check-meal-status?meal_id=${mealId}`);
//         const { status } = await response.json();
//         if (status === "accept") {
//           return true; // Meal accepted within 2 hours
//         }
//         await new Promise(resolve => setTimeout(resolve, 5000)); // Wait for 5 seconds before polling again
//       }
//       return false; // Timeout reached, meal not accepted within 2 hours
//     }
//   }
// };
</script> 
