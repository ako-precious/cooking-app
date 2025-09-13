<script setup>
import { Head } from "@inertiajs/vue3";
// import Header from "@/Layouts/Header/Index.vue";
import Footer from "@/Layouts/Footer.vue";
import ParallaxText from "@/Layouts/ParallaxText.vue";
import ScrollMask from "@/Layouts/ScrollMask.vue";
import TestimonialCarousel from "@/Layouts/TestimonialCarousel.vue";
import MeetCook from "@/Layouts/MeetCook.vue";
import StackedCard from "@/Layouts/StackedCard.vue";
import FAQ from "@/Layouts/FAQ.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    // pushSub: Boolean,
});
</script>

<script></script>

<template>
    <Head title="Welcome" />

    <section
        class="relative h-[45rem] flex flex-col items-center justify-center text-center text-snow"
    >
        <div
            class="video-docker absolute top-0 left-0 w-full h-full overflow-hidden"
        >
            <video
                class="min-w-full min-h-full absolute object-cover"
                src="images/cookingvideo.mp4"
                type="video/mp4"
                autoplay
                muted
                loop
            ></video>
        </div>
        <div class="video-content space-y-10 z-10">
            <h2 class="font-extrabold text-4xl uppercase">
                Your personal <br />
                chefs await
            </h2>
            <h3 class="font-semibold text-xl">
                A way to enjoy the taste of home <br />
                without the stress of cooking
            </h3>
        </div>

        <!-- From Uiverse.io by andrei0x309 -->
        <div
            class="w-[22rem] absolute bottom-10 z-10 bg-persian p-6 [transition:1s_ease-in-out] [clip-path:polygon(_30px_0%,_100%_0,_100%_calc(100%_-_30px),_calc(100%_-_30px)_100%,_0_100%,_0%_30px_)] rounded-tr-[20px] rounded-bl-[20px] flex flex-col"
        >
            <p
                class="text-[white] block text-center text-base font-semibold mb-2 mx-2"
            >
                Delicious meals made by local chefs, delivered weekly from $44
            </p>

            <a
                href="https://nowpayments.io/donation/andrei0x309"
                class="group/button poin relative inline-flex items-center justify-center overflow-hidden rounded-md bg-gray-800/30 backdrop-blur-lg px-6 py-2 text-base font-semibold text-white transition-all duration-300 ease-in-out hover:scale-105 hover:shadow-xl hover:shadow-gray-600/15 border border-white/20 w-[90%] mx-auto mb-[0.5rem]"
            >
                <span
                    class="group/link font-bold text-[white] text-center block text-sm group-hover/button:text-[rgb(145,_206,_46)]"
                    >Set up your weekly meal plan
                </span>
                <div
                    class="absolute inset-0 flex h-full w-full justify-center [transform:skew(-13deg)_translateX(-100%)] group-hover/button:duration-1000 group-hover/button:[transform:skew(-13deg)_translateX(100%)] ]"
                >
                    <div class="relative h-full w-10 bg-white/20"></div>
                </div>
            </a>

            <a
                href="https://nowpayments.io/donation/andrei0x309"
                class="group/button relative inline-flex items-center justify-center overflow-hidden rounded-md backdrop-blur-lg px-6 py-2 text-base font-semibold text-white transition-all duration-300 ease-in-out hover:scale-105 hover:shadow-xl hover:shadow-gray-600/15 border-b border-white/20 w-[90%] mx-auto mb-[0.5rem]"
            >
                <span
                    class="font-bold text-[white] text-center block text-sm group-hover/button:text-[rgb(145,_206,_46)]"
                    >Try a single meal experience</span
                >
                <div
                    class="absolute inset-0 flex h-full w-full justify-center [transform:skew(-13deg)_translateX(-100%)] group-hover/button:duration-1000 group-hover/button:[transform:skew(-13deg)_translateX(100%)]"
                >
                    <div class="relative h-full w-10 bg-white/20"></div>
                </div>
            </a>
        </div>

        <div
            class="space-y-10 absolute bottom-0 w-full bg-polynesian dark:bg-lighred"
        >
            <ParallaxText :baseVelocity="-3">
                We connect you with trusted local cooks who prepare authentic
                dishes from your culture — delivered straight to your door.
            </ParallaxText>
        </div>
    </section>

    <StackedCard></StackedCard>
    <section class="my-20 flex items-center justify-center container">
        <div class="w-full md:w-6/12 px-4">
            <div class="relative flex flex-col mt-4">
                <div
                    class="px-4 py-5 flex flex-col items-center text-center justify-center"
                >
                    <div
                        class="text-oynx dark:text-snow p-3 text-center inline-flex items-center justify-center w-28 h-28 rounded-full -rotate-12"
                    >
                        <img
                            width="100"
                            height="100"
                            src="images/icons8-salt-bae-100.png"
                            alt="salt-bae"
                        />
                    </div>
                    <h6 class="text-4xl mb-1 font-bold">Know Your Cook</h6>
                    <p class="mb-4 text-oynx dark:text-snow text-lg">
                        Before you order, you'll see your cook's name, story,
                        and specialty dishes, plus reviews from other customers.
                        You can also chat directly with them to create a custom
                        meal, made just for you.
                    </p>
                      <!-- From Uiverse.io by SmookyDev --> 
<button class="smky-btn3 relative font-bold  text-oynx dark:text-snow hover:text-snow py-2 px-6 after:absolute after:h-1 after:hover:h-[200%] transition-all duration-500 hover:transition-all hover:duration-500 after:transition-all after:duration-500 after:hover:transition-all after:hover:duration-500 overflow-hidden z-20 after:z-[-20] after:bg-persian after:rounded-t-full after:w-full after:bottom-0 after:left-0 capitalize ">Check the cooks near you</button>
                </div>
            </div>
        </div>
    </section>
    <MeetCook></MeetCook>
    <TestimonialCarousel></TestimonialCarousel>
     <FAQ></FAQ>
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
