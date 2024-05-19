<script setup>
import { Head, Link } from "@inertiajs/vue3";
defineProps(["account"]);
</script>
<template>
    
      <td class="whitespace-nowrap px-6 py-5 font-semibold dark:text-snow text-oynx">
        {{ account.stripe_account_id }}
      </td>
      <td v-if="account.charges_enabled == 0" class="whitespace-nowrap px-6 py-5 dark:text-snow text-oynx capitalize">
        false
      </td>
      <td v-else class="whitespace-nowrap px-6 py-5 dark:text-snow text-oynx capitalize">
        true
      </td>
      <td v-if="account.transfer_enabled == 0" class="whitespace-nowrap px-6 py-5 dark:text-snow text-oynx capitalize">
        false
      </td>
      <td v-else class="whitespace-nowrap px-6 py-5 dark:text-snow text-oynx capitalize">
        true
      </td>
      
      <td v-if="account.detailed_submitted == 0" class="whitespace-nowrap px-6 py-5">
        <div class="flex items-start">
          <div @click="Onboard(account.stripe_account_id)" class="p-2 cursor-pointer shadow-sm rounded-sm hover:shadow-xs group">
            <p class="text-base font-semibold group-action-text">Finish onboarding</p>
          </div>
        </div>
      </td>
      <td v-else class="whitespace-nowrap px-6 py-5">True</td>
      <td v-if="account.detailed_submitted == 0" class="whitespace-nowrap px-6 py-5">
       
      </td>
      <td v-else class="whitespace-nowrap px-6 py-5">
        <div class="flex items-start">
          <Link :href="`/account-session/${account.stripe_account_id}`" class="p-2 cursor-pointer shadow-sm rounded-sm hover:shadow-xs group">
            <p class="text-base font-semibold group-action-text">View Dashboard </p>
          </Link>
        </div>
      </td>
      <td class="whitespace-nowrap px-6 py-5"></td>
    
  </template>
  
<script>
import axios from "axios";
export default {
    data() {
        return {};
    },
    mounted() {
        this.FormattedDate();
        this.truncatedIng();
    },
    methods: {
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

        truncatedIng(description) {
            // Check if description exists and has more than 30 characters
            if (description && description.length > 1) {
                // Truncate description to 30 characters and add ellipsis
                return description.slice(0, 1) + "...";
            } else {
                // Return full description if it's less than or equal to 30 characters
                return description;
            }
        },
        Onboard(id) {
            // Send an HTTP request to your backend API to save the data
            axios
                .post("/account-link/" + id)
                .then((response) => {
                    window.location.href = response.data.url;
                })
                .catch((error) => {
                    // Handle error
                    console.error("Error saving data:", error);
                });
        },
        // ViewBoard(id) {
        //     // Send an HTTP request to your backend API to save the data
        //     axios
        //         .post("/account-link/" + id)
        //         .then((response) => {
        //             window.location.href = response.data.url;
        //         })
        //         .catch((error) => {
        //             // Handle error
        //             console.error("Error saving data:", error);
        //         });
        // },
    },
};
</script>
