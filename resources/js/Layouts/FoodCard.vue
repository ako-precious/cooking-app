

<script setup>

defineProps(["meal"]);
</script>
<template>
    <div
        class="group relative m-auto flex w-full max-w-xs flex-col overflow-hidden rounded-xl bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-md  hover:shadow-none dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37]  dark:shadow-oynx-md hover:dark:-shadow-none transition-all duration-200 ease delay-75"
    >
        <a class="relative flex h-50 overflow-hidden" href="#">
            <img
                class="object-cover h-fit"
                src="https://images.unsplash.com/photo-1484723091739-30a097e8f929?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTZ8fGZvb2R8ZW58MHx8MHx8fDA%3D"
                alt="product image"
            />
            <span
                class="absolute top-0 left-0 m-2 rounded-full bg-black px-2 text-center text-sm font-medium text-white"
                >New</span
            >
        </a>
        <div class="mt-2 px-5 pb-3 transition-all duration-200 ease delay-75">
            <a href="#">
                <h5
                    class="text-lg font-bold tracking-tight text-oynx dark:text-snow text-nowrap"
                >
                   {{ meal.title }}
                </h5>
            </a>
            <div class="mt-1 mb-1 flex items-center justify-between">
                <a href="#">
                    <span class="text-sm text-oynx dark:text-snow text-nowrap">{{ meal.cook.name }}</span>
                </a>
                <div class="flex items-center">
                    <font-awesome-icon icon="star" class="text-persian" />
                    <span
                        class="mr-2 ml-3 rounded bg-persian px-2.5 py-0.5 text-xs font-semibold"
                        >5.0</span
                    >
                </div>
            </div>
            <div class="flex items-center justify-between">
                <p>
                    <span class="text-lg font-bold text-oynx dark:text-snow"
                        >$14</span
                    >
                </p>
                <div
                    class="items-center justify-end rounded-md flex opacity-0 group-hover:opacity-100 py-2 group-hover:m-0 text-center text-sm font-medium text-snow focus:outline-none transition-all duration-200 delay-75 ease"
                >
                    <font-awesome-icon
                        icon="fa-regular fa-heart"
                        class="text-xl pr-2 text-oynx active:text-polynesian hover:text-polynesian dark:text-snow dark:active:text-lighred dark:hover:text-lighred"
                    />
                    <font-awesome-icon
                        icon="circle-plus"
                        class="text-xl px-2 text-oynx active:text-polynesian hover:text-polynesian dark:text-snow dark:active:text-lighred dark:hover:text-lighred"
                    />
                    <font-awesome-icon
                        icon="share"
                        class="text-xl px-2 text-oynx active:text-polynesian hover:text-polynesian dark:text-snow dark:active:text-lighred dark:hover:text-lighred"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
<style scoped>
.foodcard {
    background: linear-gradient(145deg, #e3dedf, #ffffff);
    box-shadow: 10px 10px 15px #cac6c6, -10px -10px 15px #ffffff;
}
.foodcard:hover {
    background: linear-gradient(145deg, #e3dedf, #ffffff);
    box-shadow: -10px -10px 15px #a19e9f, 10px 10px 15px #ffffff;
}
@media (prefers-color-scheme: dark) {
    .dark\:foodcard {
        background: linear-gradient(145deg, #2b312e, #333a37);
        box-shadow: 10px 10px 15px #262b29, -10px -10px 15px #3a413d;
    }
    .dark\:foodcard:hover {
        /* border-radius: 15px; */
        background: linear-gradient(145deg, #2b312e, #333a37);
        box-shadow: -10px -10px 15px #262b29, 10px 10px 15px #3a413d;
    }
}
</style>
