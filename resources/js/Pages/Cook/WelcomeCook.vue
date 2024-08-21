
<script setup>
import axios from "axios";
import { Head, Link } from "@inertiajs/vue3";
</script>
<template>
    <div class="py-6 lg:py-12 px-4">
                    <h1
                        class="font-semibold text-3xl lg:text-5xl text-oynx dark:text-snow pb-3"
                    >
                        Glad you're back,
                        <span class="capitalize">
                            {{ firstWord }}
                            <!-- {{ firstWord($page.props.auth.user.name ) }} -->
                        </span>
                    </h1>

                 <Link   :href="route('user.show', {id:  $page.props.auth.user.id,})" class="relative flex items-center rounded-md  text-sm text-persian hover:text-polynesian dark:hover:text-lighred cursor-pointer transition-all duration-200 ease-in-out"
                                        >
                                         Edit your availability, profile and more </Link>  
                </div>
</template>

<script>
import axios from "axios";
import { Head, Link } from "@inertiajs/vue3";
export default {
    props: {
       
    },
    data() {
        
    },
    computed: {
        firstWord() {
            // Check if $page.props.auth.user.name is defined
            if (
                this.$page.props.auth &&
                this.$page.props.auth.user &&
                this.$page.props.auth.user.name
            ) {
                // Split the name string into an array of words
                const words = this.$page.props.auth.user.name.split(" ");

                // Return the first word
                return words[0];
            } else {
                return ""; // Return an empty string if $page.props.auth.user.name is undefined
            }
        },
       
    },

    methods: {
      
    },
};
</script>