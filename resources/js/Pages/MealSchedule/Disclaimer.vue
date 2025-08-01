<script setup>
import axios from "axios";
import PrimaryButton from "@/Components/PrimaryButton.vue";
</script>


<template>    

    <div
    id="defaultModal"
    tabindex="-1"
    aria-hidden="true"
    class=" overflow-y-auto overflow-x-hidden flex justify-center items-center fixed top-0 right-0 left-0 w-full md:inset-0 h-modal md:h-full z-990"
    >
    <div class="relative p-4  w-full m-auto max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-snow rounded-lg shadow dark:bg-oynx">
            <!-- Modal header -->
            <div
                class="flex justify-center items-start p-4 rounded-t border-b dark:border-oynx"
            >
                <h3
                    class="text-xl font-semibold t text-oynx lg:text-2xl dark:text-snow"
                >
                    MyMealni Checkout Consent
                </h3>
                
            </div>
            <!-- Modal body -->
            <div class="h-60 overflow-y-auto p-5 space-y-6">
                <p
                    class="text-lg leading-relaxed text-oynx dark:text-gray-400"
                >
                   Before completing your order, please read and agree to the following:
                </p>
                <p
                    class="text-base leading-relaxed text-oynx dark:text-gray-400"
                >
                    <ol class=" list-decimal  list-inside  text-oynx dark:text-gray-400 "><li>Meals are prepared by independent cooks, not MyMealni.</li>
                    <li>Allergen & dietary information must be reviewed carefully before ordering.</li>
                    <li>MyMealni is a facilitator: we handle payments and delivery but do not cook or produce meals.</li>
                    <li>By paying, you release MyMealni from liability for issues related to meal preparation, within the limits of applicable law.</li>
                    <li>Refunds are only provided for missing items, non-delivery, or proven safety concerns.</li></ol>
                </p>
              
                <p
                    class="text-base leading-relaxed text-oynx dark:text-gray-400"
                >
                We encourage you to read carefully before placing your order with Mymealni. By proceeding, you confirm your understanding and acceptance of the terms."
                </p>
            </div>
            <!-- Modal footer -->
            <div   @click="$emit('close')"
                class="flex items-center justify-end pb-4 px-5 space-x-2 rounded-b border-t border-snow dark:border-oynx"
            >
                <PrimaryButton @click="Agreement"
                >I Agree </PrimaryButton>
              
            </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {
    inheritAttrs: false,
    props: {
        newSchedule: Object,
    },

    data() {
        return {
           
        };
    },

    methods: {
    
        Agreement(){
 

            // const wishlistData = {
            //     agreed : 'agreed',
            //     user_id: this.$page.props.auth.user.id,
            // };
            // axios
            //     .put("api/agreement/" +  this.$page.props.auth.user.id, wishlistData)
            //     .then((response) => {
                                  
                   
                    
            //     })
            //     .catch((error) => {
            //         // console.error("Error adding to wishlist:", error);
            //     });
        }
    },
};
</script>
