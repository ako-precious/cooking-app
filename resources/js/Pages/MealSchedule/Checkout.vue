<template>
  <div id="checkout">
    <!-- Checkout will insert the payment form here -->
  </div>
</template>

<script>
export default {
  props: {
    mealSchedule: Object,
  },
  mounted() {
    this.initializeStripeCheckout();
  },
  methods: {
    async initializeStripeCheckout() {
      const mealId = this.mealSchedule.id;
      
      // Initiate the payment session and get client secret
      const response = await fetch(`/checkout?schedule_id=${mealId}`, {
        method: "POST",
      });
      const { clientSecret } = await response.json();
      
      // Initialize Stripe
      const stripe = Stripe('pk_test_51OjplDL2JFKeogL4wsxVYfkG8zCegW66jPKapqF6QtnmakopSVRHFn2YE4tuQK4ZhZROFhJ9iTohD5dZ2wlS1H9x00zqkwyGg2');
      
      // Create a checkout instance
      const checkout = await stripe.initEmbeddedCheckout({
        clientSecret,
      });
      
      // Mount Checkout form
      checkout.mount('#checkout');
      
      // Listen for payment success
      checkout.on('paymentSuccess', async () => {
        // Wait for meal status change to "accept" within 2 hours
        const isAccepted = await this.waitForAcceptance(mealId);
        
        if (isAccepted) {
          // Payment and meal acceptance successful
          console.log("Payment successful and meal accepted.");
        } else {
          // Meal acceptance failed within the timeframe
          console.log("Meal acceptance failed within 2 hours.");
        }
      });
    },
    async waitForAcceptance(mealId) { 
      // Poll the backend to check meal status every few seconds
      const start = Date.now();
      while (Date.now() - start < 2 * 60 * 60 * 1000) { // 2 hours
        const response = await fetch(`/check-meal-status?meal_id=${mealId}`);
        const { status } = await response.json();
        if (status === "accept") {
          return true; // Meal accepted within 2 hours
        }
        await new Promise(resolve => setTimeout(resolve, 5000)); // Wait for 5 seconds before polling again
      }
      return false; // Timeout reached, meal not accepted within 2 hours
    }
  }
};
</script>
