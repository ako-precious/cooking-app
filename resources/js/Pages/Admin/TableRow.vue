<script setup>
import { Head, Link } from "@inertiajs/vue3";
defineProps(["account"]);
</script>
<template>
    
      <td class="whitespace-nowrap px-6 py-5 font-semibold dark:text-snow text-oynx capitalize">
        {{ account.user.name }}
      </td>
      <td class="whitespace-nowrap px-6 py-5 font-semibold dark:text-snow text-oynx">
        {{ account.user.email }}
      </td>
      <td class="whitespace-nowrap px-6 py-5 font-semibold dark:text-snow text-oynx">
        {{ account.user.phone_number }}
      </td>
      <td class="whitespace-nowrap px-6 py-5 font-semibold dark:text-snow text-oynx">
        <img
                        :src="truncatedImg(account.means_of_id)"
                        :alt="truncatedImg(account.means_of_id)"
                        class="w-full h-full object-cover rounded"
                    />
      </td>
      <td class="whitespace-nowrap px-6 py-5 font-semibold dark:text-snow text-oynx">
        <img
                        :src="truncatedImg(account.certificate)"
                        :alt="truncatedImg(account.certificate)"
                        class="w-full h-full object-cover rounded"
                    />
      </td>
      <td class="whitespace-nowrap px-6 py-5 font-semibold dark:text-snow text-oynx">
        {{ cook_status }}
      </td>
      
       
      <td  class="whitespace-nowrap px-6 py-5">
        <div class="flex items-start">
          <div v-if="account.status == 'pending' " :href="`/account-session/${account.stripe_account_id}`" @click="Onboard(account.id, 'available')" class="p-2 cursor-pointer shadow-sm rounded-sm hover:shadow-xs group">
            <p class="text-base font-semibold group-action-text">Approve</p>
          </div>
          <div v-if="account.status == 'pending' " :href="`/account-session/${account.stripe_account_id}`" @click="Onboard(account.id, 'unavailable')" class="p-2 ml-2 cursor-pointer shadow-sm rounded-sm hover:shadow-xs group">
            <p class="text-base font-semibold group-action-text">Disapprove</p>
          </div>
          <div v-if="account.status == 'available' " :href="`/account-session/${account.stripe_account_id}`" @click="Onboard(account.id, 'pending')" class="p-2 cursor-pointer shadow-sm rounded-sm hover:shadow-xs group">
            <p class="text-base font-semibold group-action-text">Pending</p>
          </div>
        </div>
      </td>
      <td class="whitespace-nowrap px-6 py-5"></td>
    
  </template>
  
<script>
import axios from "axios";
export default {
    data() {
        return {cook_status: this.account.status};
    },
    mounted() {
        this.FormattedDate();
        this.truncatedImg();
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

        truncatedImg(photo) {
          return  `/storage/${photo}`.replace("/public","");
        },
        Onboard(id, status ) {
            // Send an HTTP request to your backend API to save the data
            axios
                .put("/ako-precious/" + id, {status} )
                .then((response) => {
                    this.cook_status = response.data.cook.status;
                    // this.meal.status =  newStatus;
                })
                .catch((error) => {
                    // Handle error
                    console.error("Error saving data:", error);
                });
        },
    },
};
</script>
