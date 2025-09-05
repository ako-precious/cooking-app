<script setup>
import { Head } from "@inertiajs/vue3";
// import Header from "@/Layouts/Header/Index.vue";
import Footer from "@/Layouts/Footer.vue";
import ParallaxText from '@/Layouts/ParallaxText.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    // pushSub: Boolean,
});
</script>

<script>

</script>

<template>
    <Head title="Welcome" />
   

<section class="relative h-screen flex flex-col items-center justify-center text-center text-white ">
    <div class="video-docker absolute top-0 left-0 w-full h-full overflow-hidden">
        <video class="min-w-full min-h-full absolute object-cover"
            src="images/cookingvideo.mp4"
            type="video/mp4" autoplay muted loop></video>
    </div>
    <div class="video-content space-y-2 z-10">
        <h1 class="font-extrabold  text-6xl uppercase  ">Your personal <br> chefs await</h1>
        <h3 class="font-semibold text-3xl capitalize">Just pick what you want</h3>
    </div>
    
</section>
<div class="space-y-10 absolute bottom-5 w-full z-10">
<ParallaxText :baseVelocity="-4">Framer Motion</ParallaxText>
<ParallaxText :baseVelocity="4">Scroll velocity</ParallaxText>

</div>

   

    <Footer></Footer>
</template>


<style scoped>
    .video-docker video {
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .video-docker::after {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 1;
    }
</style>

<!-- <style scoped>
.button {
    --color: #1b998b;
    font-family: inherit;
    display: inline-block;
    width: 8em;
    height: 2.6em;
    line-height: 2.5em;
    margin: 10px;
    position: relative;
    overflow: hidden;
    border: 2px solid var(--color);
    transition: color 0.5s;
    z-index: 1;
    font-size: 17px;
    border-radius: 6px;
    font-weight: 600;
    color: var(--color);
}

.button:before {
    content: "";
    position: absolute;
    z-index: -1;
    background: var(--color);
    height: 150px;
    width: 200px;
    border-radius: 50%;
}

.button:hover {
    color: #fff;
}

.button:before {
    top: 100%;
    left: 100%;
    transition: all 0.7s;
}

.button:hover:before {
    top: -30px;
    left: -30px;
}

.button:active:before {
    background: #0e534b;
    transition: background 0s;
}
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}


@keyframes fade-in {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-in;
}
</style> -->
