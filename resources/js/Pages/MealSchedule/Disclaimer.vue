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
                    Terms of Service
                </h3>
                
            </div>
            <!-- Modal body -->
            <div class="h-60 overflow-y-auto p-5 space-y-6">
                <p
                    class="text-sm leading-relaxed text-oynx dark:text-gray-400"
                >
                    Mymealni is a  cooking platform that connects
                    home cooks with food lovers. Please be aware that meals
                    prepared by our home cooks are typically made in
                    their personal homes, which may not have been inspected
                    by public health officials. However, we ensure that all
                    our cooks hold a valid Food Handling Certificate,
                    demonstrating their understanding of proper food
                    handling and safety practices.
                </p>
                <p
                    class="text-sm leading-relaxed text-oynx dark:text-gray-400"
                >
                    While we take steps to ensure the quality and safety of
                    our meals, we want to transparently disclose this
                    information to our customers. Additionally, we encourage
                    customers to rate their meals after each order, helping
                    us maintain high standards and accountability within our
                    community.
                </p>
                <p
                    class="text-sm leading-relaxed text-oynx dark:text-gray-400"
                >
                    Please note that our platform is in its early stages,
                    and many of our student cooks share apartments, making
                    it challenging to meet traditional commercial kitchen
                    inspection standards. We appreciate your understanding
                    and support as we grow and evolve.
                </p>
                <p
                    class="text-sm leading-relaxed text-oynx dark:text-gray-400"
                >
                    Please note that our platform is in its early stages,
                    and many of our student cooks share apartments, making
                    it challenging to meet traditional commercial kitchen
                    inspection standards. We appreciate your understanding
                    and support as we grow and evolve.
                </p>
                <p
                    class="text-sm leading-relaxed text-oynx dark:text-gray-400"
                >
                We encourage you to read our disclaimer carefully before placing your order with Mymealni. By proceeding, you confirm your understanding and acceptance of the terms."
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
