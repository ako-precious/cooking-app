<script setup>
import { Head, Link } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Become A Cook" />
<div class="container py-5  bg-snow dark:bg-oynx">
<div class="flex justify-between items-center">
    <div class=""> LOGO
    </div>
    
    <div class=" w-32  navbar-link font-semibold shadow-reverse p-3 rounded-full text-sm ">
       <Link :href="`/cook/menu`" > Save and Exist</Link></div>
</div>
 <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center selection:bg-red-500 selection:text-white"
    >
        <!-- <Overview /> -->
        <slot name="info" class="animate-fade-in delay-100"></slot>

        <div class="fixed h-20 shadow-reverse w-full bottom-0">
           <slot class="animate-left-in" name="progressbar"></slot>
            <slot name="backbtn" ></slot>
            <slot name="mainbtn"></slot>
            
        </div>
    </div></div>
</template>

<!-- Saving for later -->
<!-- "Indulge your taste buds and unlock a world of culinary delights with our platform, where passionate home chefs transform ordinary ingredients into extraordinary experiences. From tantalizing dishes to mouthwatering desserts, our community of food artisans invites you to savor their creations and bring the flavors of the world into your home. Whether you're seeking a gourmet feast for a special occasion or craving everyday comfort food made with love, discover your perfect match among our talented cooks who are ready to turn your cravings into unforgettable culinary adventures." -->

<style scoped>
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
