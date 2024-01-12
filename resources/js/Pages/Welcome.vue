<script setup>
import { Head } from "@inertiajs/vue3";
import DropBarNav from "./Header/DropBarNav.vue";
import FoodCard from "./FoodCard.vue";
import DateRangePicker from "./Header/DateRangePicker.vue";
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>


<template>
    <Head title="Welcome" />

    <!-- component -->
    <header class="bg-snow dark:bg-oynx ">
        <div
            class="container mx-auto px-4 lg:px-10 py-1 flex justify-between items-center"
        >
            <!-- logo -->
            <div class="md:w-48 flex-shrink-0">
                <img
                    class="h-8 md:h-10"
                    src="https://i.ibb.co/98pHdFq/2021-10-27-15h51-15.png"
                    alt=""
                />
            </div>

            <!-- search -->
            <div
                class="w-full max-w-xs lg:max-w-lg 2xl:max-w-2xl bg-snow dark:bg-oynx rounded-md hidden lg:flex items-center"
            >
                <div
                    class="bg-transparent capitalize font-bold text-sm p-4 mr-4 flex justify-around w-full"
                    name=""
                    id="">
                    <a
                        class="text-oynx active:text-polynesian hover:text-polynesian dark:text-snow dark:active:text-lighred dark:hover:text-lighred rounded-full cook dark:cook py-2 px-3"
                        href="">
                        <p>Meal Schedule</p>
                    </a>
                    <a
                        class="text-oynx active:text-polynesian hover:text-polynesian dark:text-snow dark:active:text-lighred dark:hover:text-lighred rounded-full cook dark:cook py-2 px-3"
                        href=""
                    >
                        <p>Special Meal</p>
                    </a>
                    <a
                        class="text-oynx active:text-polynesian hover:text-polynesian dark:text-snow dark:active:text-lighred dark:hover:text-lighred rounded-full cook dark:cook py-2 px-3"
                        href=""
                    >
                        <p>Be a Cook</p>
                    </a>
                </div>
            </div>

            <!-- buttons -->
            <nav class="contents">
                <ul class="ml-4 xl:w-48 flex items-center justify-end">
                    <li
                        class="ml-2 text-nowrap relative inline-block dark:bg-oynx rounded-full py-2 px-4 cook dark:cook"
                    >
                        <a
                            class="text-oynx active:text-polynesian hover:text-polynesian dark:text-snow dark:active:text-lighred dark:hover:text-lighred"
                            href="" >
                            <p>Be a Cook</p>
                        </a>
                    </li>
                    <li
                        class="ml-2 relative inline-block text-oynx active:text-polynesian hover:text-polynesian dark:text-snow dark:active:text-lighred dark:hover:text-lighred bg-oynx rounded-full p-1 cook dark:cook"
                    >
                        <a class="" href="">
                            <font-awesome-icon
                                icon="globe"
                                class="h-3 lg:h-4 p-2 svg-inline--fa fa-user fa-w-14 fa-9x"
                            />
                        </a>
                    </li>
                    <DropBarNav
                        :canLogin="canLogin"
                        :canRegister="canRegister"
                        :laravelVersion="laravelVersion"
                        :phpVersion="phpVersion"
                    />
                </ul>
            </nav>
        </div>
        <DateRangePicker></DateRangePicker>
          <hr />
    </header>

    <div
        class="container  px-4 lg:p-10  mx-auto relative grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 sm:items-center min-h-screen selection:bg-red-500 selection:text-white"
    >
    <FoodCard></FoodCard>
    <FoodCard></FoodCard>
    <FoodCard></FoodCard>
    <FoodCard></FoodCard>
    </div>
</template>

<style scoped>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
.profile {
    background: linear-gradient(145deg, #e3dedf, #ffffff);
    box-shadow: 25px 25px 53px #a19e9f, -25px -25px 53px #ffffff;
}
.profile:hover {
    background: linear-gradient(315deg, #e3dedf, #ffffff);
    box-shadow: -25px -25px 53px #a19e9f, 25px 25px 53px #ffffff;
}
.cook:hover {
    background: linear-gradient(315deg, #e3dedf, #ffffff);
    box-shadow: -25px -25px 53px #a19e9f, 25px 25px 53px #ffffff;
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
    .dark\:profile {
        background: linear-gradient(145deg, #2b312e, #333a37);
        box-shadow: 18px 18px 36px #1f2321, -18px -18px 36px #414945;
    }
    .dark\:profile:hover {
        background: linear-gradient(315deg, #2b312e, #333a37);
        box-shadow: -18px -18px 36px #1f2321, 18px 18px 36px #414945;
    }
    .dark\:cook:hover {
        background: linear-gradient(315deg, #2b312e, #333a37);
        box-shadow: -18px -18px 36px #1f2321, 18px 18px 36px #414945;
    }
}

.input {
    /* width: 200px; */
    height: 45px;
    border: none;
    outline: none;

    border-radius: 6px;
    color: #fff;
    font-size: 15px;
    background-color: transparent;
    border-radius: 53px;
    background: linear-gradient(145deg, #cacaca, #f0f0f0);
    box-shadow: 25px 25px 50px #727272, -25px -25px 50px #ffffff;
    /* box-shadow: 3px 3px 10px rgba(0,0,0,1),
  -1px -1px 6px rgba(255, 255, 255, 0.4); */
}

.input:focus {
    border: 2px solid transparent;
    color: #fff;
    box-shadow: 3px 3px 10px rgba(0, 0, 0, 1),
        -1px -1px 6px rgba(255, 255, 255, 0.4),
        inset 3px 3px 10px rgba(0, 0, 0, 1),
        inset -1px -1px 6px rgba(255, 255, 255, 0.4);
}

.divcontainer .input:valid,
.divcontainer .input:focus {
    box-shadow: 3px 3px 10px rgba(0, 0, 0, 1),
        -1px -1px 6px rgba(255, 255, 255, 0.4),
        inset 3px 3px 10px rgba(0, 0, 0, 1),
        inset -1px -1px 6px rgba(255, 255, 255, 0.4);
}
</style>
