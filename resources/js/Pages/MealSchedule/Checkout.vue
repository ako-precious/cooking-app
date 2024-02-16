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
        
        console.log(this.mealSchedule.id )
      this.initializeStripeCheckout();
    },
    methods: {
      async initializeStripeCheckout() {
        const id =  this.mealSchedule.id 
        // const response = await fetch(`/checkout?meal=${id}}`, {
        //   method: "POST",
        // });
        const response = await fetch(`/checkout?meal_id=${id}`, {
    method: "POST",
});
        
        const { clientSecret } = await response.json();
        
        const stripe = Stripe("pk_test_51OjplDL2JFKeogL4wsxVYfkG8zCegW66jPKapqF6QtnmakopSVRHFn2YE4tuQK4ZhZROFhJ9iTohD5dZ2wlS1H9x00zqkwyGg2");
        const checkout = await stripe.initEmbeddedCheckout({
          clientSecret,
        });
        
        // Mount Checkout
        checkout.mount('#checkout');
      }
    }
  }
  </script>
  