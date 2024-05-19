<template>
    <div id="container">
      <div v-if="hasError">Something went wrong!</div>
    </div>
  </template>
  
  <script>
  import { loadConnectAndInitialize } from "@stripe/connect-js";
  
  export default {
    props: {
        account : String
    },
    data() {
      return { hasError: false };
    },
    mounted() {
      const fetchClientSecret = async () => {
        try {
          const response = await fetch('/dashboard-link/'+ this.account, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
          });
          if (!response.ok) {
            const { error } = await response.json();
            console.error('An error occurred: ', error);
            this.hasError = true;
            return undefined;
          } else {
            const { client_secret: clientSecret } = await response.json();
            this.hasError = false;
            return clientSecret;
          }
        } catch (error) {
          console.error('An error occurred: ', error);
          this.hasError = true;
          return undefined;
        }
      };
  
      const initializeStripe = async () => {
        const clientSecret = await fetchClientSecret();
        if (clientSecret) {
          const instance = await loadConnectAndInitialize({
            publishableKey: 'pk_test_51OjplDL2JFKeogL4wsxVYfkG8zCegW66jPKapqF6QtnmakopSVRHFn2YE4tuQK4ZhZROFhJ9iTohD5dZ2wlS1H9x00zqkwyGg2',
            fetchClientSecret: fetchClientSecret,
            appearance: {
              overlays: 'dialog',
              variables: {
                colorPrimary: '#625afa',
              },
            },
          });
          const container = document.getElementById("container");
          const paymentsComponent = instance.create("payments");
          container.appendChild(paymentsComponent);
        }
      };
  
      initializeStripe();
    },
  };
  </script>
  