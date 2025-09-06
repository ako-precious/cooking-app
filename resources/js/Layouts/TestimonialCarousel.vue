<script setup>
import { ref } from "vue";

const testimonialActive = ref(1);

const testimonials = [
    {
        id: 1,
        text: "I recently moved to Canada and missed the taste of home. Through MyMealni, I found a local cook who made the exact traditional dishes I grew up with. It felt like a warm hug in a meal!",
        name: "Amara O.",
        location: "Barrie",
        initials: "AO",
    },
    {
        id: 2,
        text: "Ordering from MyMealni has been such a game changer. Instead of fast food, I now get fresh, homemade meals delivered the next day. The flavors remind me of my mom’s cooking.",
        name: "Daniel K.",
        location: "Barrie",
        initials: "DK",
    },
    {
        id: 3,
        text: "I love how MyMealni connects me to cooks from different cultures. Last week I tried authentic Ethiopian injera and it was incredible. It’s like traveling the world through food.",
        name: "Sofia R.",
        location: "Inisfil",
        initials: "SR",
    },
    {
        id: 4,
        text: "As a busy parent, I don’t always have time to cook. MyMealni lets me order healthy meals for my kids without worrying about long prep times or junk food. It’s been a lifesaver.",
        name: "Melissa T.",
        location: "Barrie",
        initials: "MT",
    },
    {
        id: 5,
        text: "I signed up as a cook on MyMealni to share my Caribbean recipes, and now I have regular customers who love my food. It feels amazing to earn extra income doing something I enjoy.",
        name: "Jamal B.",
        location: "Inisfil",
        initials: "JB",
    },
    {
        id: 6,
        text: "With MyMealni, I’ve discovered meals I never would have tried otherwise. It’s affordable, authentic, and always fresh. My coworkers keep asking where I get my lunches from!",
        name: "Priya S.",
        location: "Barrie",
        initials: "PS",
    },
    {
        id: 7,
        text: "Cooking through MyMealni has helped me connect with people in my community. I love seeing customers enjoy the flavors of my culture—it’s more than food, it’s sharing tradition.",
        name: "Fatima H.",
        location: "Barrie",
        initials: "FH",
    },
];

const prev = () => {
    testimonialActive.value =
        testimonialActive.value === 1
            ? testimonials.length
            : testimonialActive.value - 1;
};

const next = () => {
    testimonialActive.value =
        testimonialActive.value >= testimonials.length
            ? 1
            : testimonialActive.value + 1;
};
</script>

<template>
    <div
        class="my-10 md:my-24 container mx-auto flex flex-col md:flex-row shadow-sm overflow-hidden"
    >
        <!-- Left Side -->
        <div
            class="relative w-full py-2 md:py-24 bg-persian md:w-1/2 flex flex-col justify-center"
        >
            <div
                class="absolute top-0 left-0 z-10 grid-indigo w-16 h-16 md:w-40 md:h-40 md:ml-20 md:mt-24"
            ></div>

            <div
                class="relative text-2xl md:text-5xl py-2 px-6 md:py-6 md:px-1 md:w-72 md:mx-auto text-indigo-100 font-semibold leading-tight tracking-tight mb-0 z-20 uppercase text-center"
            >
                <span class="md:block">What Trusting</span>
                <span class="md:block">Households</span>
                <span class="block">Are Saying!</span>
            </div>

            <!-- Controls -->
            <div class="absolute right-0 bottom-0 mr-4 mb-4 hidden md:block">
                <button
                    class="rounded-l-full border-r bg-gray-100 text-gray-500 focus:outline-none hover:text-indigo-500 font-bold w-12 h-10"
                    @click="prev"
                >
                    &#8592;
                </button>
                <button
                    class="rounded-r-full bg-gray-100 text-gray-500 focus:outline-none hover:text-indigo-500 font-bold w-12 h-10"
                    @click="next"
                >
                    &#8594;
                </button>
            </div>
        </div>

        <!-- Right Side -->
        <div class="bg-gray-100 md:w-1/2">
            <div class="flex flex-col h-full relative">
                <!-- Quote Icon -->
                <div class="absolute top-0 left-0 mt-3 ml-4 md:mt-5 md:ml-12">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="text-indigo-200 fill-current w-12 h-12 md:w-16 md:h-16"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M6.5 10c-.223 0-.437.034-.65.065.069-.232.14-.468.254-.68.114-.308.292-.575.469-.844.148-.291.409-.488.601-.737.201-.242.475-.403.692-.604.213-.21.492-.315.714-.463.232-.133.434-.28.65-.35.208-.086.39-.16.539-.222.302-.125.474-.197.474-.197L9.758 4.03c0 0-.218.052-.597.144C8.97 4.222 8.737 4.278 8.472 4.345c-.271.05-.56.187-.882.312C7.272 4.799 6.904 4.895 6.562 5.123c-.344.218-.741.4-1.091.692C5.132 6.116 4.723 6.377 4.421 6.76c-.33.358-.656.734-.909 1.162C3.219 8.33 3.02 8.778 2.81 9.221c-.19.443-.343.896-.468 1.336-.237.882-.343 1.72-.384 2.437-.034.718-.014 1.315.028 1.747.015.204.043.402.063.539.017.109.025.168.025.168l.026-.006C2.535 17.474 4.338 19 6.5 19c2.485 0 4.5-2.015 4.5-4.5S8.985 10 6.5 10zM17.5 10c-.223 0-.437.034-.65.065.069-.232.14-.468.254-.68.114-.308.292-.575.469-.844.148-.291.409-.488.601-.737.201-.242.475-.403.692-.604.213-.21.492-.315.714-.463.232-.133.434-.28.65-.35.208-.086.39-.16.539-.222.302-.125.474-.197.474-.197L20.758 4.03c0 0-.218.052-.597.144-.191.048-.424.104-.689.171-.271.05-.56.187-.882.312-.317.143-.686.238-1.028.467-.344.218-.741.4-1.091.692-.339.301-.748.562-1.05.944-.33.358-.656.734-.909 1.162C14.219 8.33 14.02 8.778 13.81 9.221c-.19.443-.343.896-.468 1.336-.237.882-.343 1.72-.384 2.437-.034.718-.014 1.315.028 1.747.015.204.043.402.063.539.017.109.025.168.025.168l.026-.006C13.535 17.474 15.338 19 17.5 19c2.485 0 4.5-2.015 4.5-4.5S19.985 10 17.5 10z"
                        />
                    </svg>
                </div>

                <!-- Testimonial Text -->
                <div class="h-full relative z-10">
                    <p
                        v-for="t in testimonials"
                        :key="t.id"
                        v-show="testimonialActive === t.id"
                        class="text-gray-600 serif font-normal italic px-6 py-6 md:px-16 md:py-10 text-xl md:text-2xl transition-opacity duration-300"
                    >
                        {{ t.text }}
                        
                        {{ t.name }}
                        {{ t.location }}
                    </p>
                </div>

                <!-- Dots / Buttons -->
                <div class="flex my-4 justify-center items-center">
                    <button
                        v-for="t in testimonials"
                        :key="t.id"
                        @click="testimonialActive = t.id"
                        class="text-center font-bold shadow-xs focus:outline-none focus:shadow-outline inline-block rounded-full mx-2 transition-all"
                        :class="
                            testimonialActive === t.id
                                ? 'h-16 w-16 opacity-100 bg-persian text-white'
                                : 'h-12 w-12 opacity-25 bg-indigo-300 text-gray-600'
                        "
                    >
                        {{ t.initials }}
                    </button>
                </div>

                <!-- User Info -->

                <!-- User Info -->
                <div class="flex flex-col items-center justify-center px-6 pt-2 pb-6 md:py-6"> 
                    <p  v-for="t in testimonials"
                        :key="t.id"
                        v-show="testimonialActive === t.id"
                         class="text-sm md:text-base font-bold text-gray-700 leading-tight">                    
                        
                        {{ t.name }}                        
                    </p>
                    <p  v-for="t in testimonials"
                        :key="t.id"
                        v-show="testimonialActive === t.id"
                          class="text-gray-500 text-xs md:text-sm truncate">                    
                        
                        {{ t.location }}                        
                    </p>
                    </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.serif {
    font-family: "Zilla Slab", serif;
}
.grid-indigo {
    background-image: radial-gradient(#84d4ccd8 2px, transparent 2px);
    background-size: 16px 16px;
}
</style>
