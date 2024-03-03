<script setup>
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    
    <header class="py-5 bg-snow dark:bg-oynx">
        <div
            :class="{ fix : isHeaderFixed }"
            class="flex justify-between items-center w-full bg-snow dark:bg-oynx "
        >
            <div class="">LOGO</div>

            <div
                class="w-32 navbar-link font-semibold shadow-reverse p-2 text-center rounded-full text-sm"
            >
                <Link :href="`/cook/menu`"> Save and Exist</Link>
            </div>
        </div>
       
    </header>
</template>

<script>
export default {
    inheritAttrs: false,
    data() {
        return {
            isHeaderFixed: false,
        };
    },
    mounted() {
        window.addEventListener("scroll", this.handleScroll);
    },
    beforeDestroy() {
        window.removeEventListener("scroll", this.handleScroll);
    },
   
    methods: {
        handleScroll() {
            // Adjust the scroll threshold as needed
            const scrollThreshold = 20;
            this.isHeaderFixed = window.scrollY > scrollThreshold;
        },
    },
};
</script>

<!-- Saving for later -->
<!-- "Indulge your taste buds and unlock a world of culinary delights with our platform, where passionate home chefs transform ordinary ingredients into extraordinary experiences. From tantalizing dishes to mouthwatering desserts, our community of food artisans invites you to savor their creations and bring the flavors of the world into your home. Whether you're seeking a gourmet feast for a special occasion or craving everyday comfort food made with love, discover your perfect match among our talented cooks who are ready to turn your cravings into unforgettable culinary adventures." -->

<style scoped>
.fix {
    position: fixed;
    top: 0;
    width: 100%;
    padding:  1.5rem 0;
    padding-right: 4rem;
    z-index: 1000; /* Adjust z-index as needed */
}
</style>
