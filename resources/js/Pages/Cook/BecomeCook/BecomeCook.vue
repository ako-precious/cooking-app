<script setup>
import { Head, Link } from "@inertiajs/vue3";

import ApplicationMark from "@/Components/ApplicationMark.vue";
</script>

<template>
    <Head title="Become A Cook" />
    <div class="container py-5 bg-snow dark:bg-oynx">
        <div
            :class="{ 'fix align-bottom shadow-sm': isHeaderFixed }"
            class="flex justify-between items-center w-full bg-snow dark:bg-oynx"
        >
            <Link :href="route('welcome')">
                <div class="w-full flex items-center">
                    <ApplicationMark class="block" />
                </div>
            </Link>

            <div
                class="w-32 navbar-link font-semibold border p-2 text-center rounded-full text-sm"
            >
                <Link :href="`/cook/menu`"> Save and Exist</Link>
            </div>
        </div>
        <div
            class="relative flex justify-center items-center min-h-screen bg-center selection:bg-red-500 selection:text-white"
        >
            <!-- <Overview /> -->
            <slot name="info" class="animate-fade-in delay-100"></slot>

            <div class="fixed h-20 shadow-extra-small shadow-none w-full bottom-0">
                <slot class="animate-left-in" name="progressbar"></slot>
                <slot name="backbtn"></slot>
                <slot name="mainbtn" class="shadow-none"></slot>
            </div>
        </div>
    </div>
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
    right: 0;
    width: 100%;
    padding: 1rem 3rem;
    z-index: 1000; /* Adjust z-index as needed */
}

.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
@keyframes fade-in {
    from {
        opacity: 0;
        bottom: -15rem;
    }
    to {
        opacity: 1;
        bottom: 0;
    }
}

.animate-fade-in {
    animation: fade-in 0.7s ease-in;
}
@keyframes left-in {
    from {
        opacity: 0;
        left: -15rem;
    }
    to {
        opacity: 1;
        left: 0;
    }
}

.animate-left-in {
    animation: left-in 0.7s ease-in;
}
</style>
