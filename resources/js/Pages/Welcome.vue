<script setup>
import { Head, Link } from "@inertiajs/vue3";
// import { Application } from '@splinetool/runtime';

// import { Application } from '@splinetool/runtime';

// template ref
// const canvas = ref(null)

// // spline state
// const state = reactive({
//     spline: {
//         scene: "https://prod.spline.design/<your-spline-scene-url>/scene.splinecode",
//         app: null,
//         isLoaded: false,
//     },
// });

// onMounted(async () =>{
//     const app = new Application(canvas.value);
//     await app.load(state.spline.scene)
//     state.spline.app = app;
//     state.spline.isLoaded = true;
// })
</script>
<!-- <script type="module" src="https://unpkg.com/@splinetool/viewer@1.0.17/build/spline-viewer.js"></script> -->
<!-- <spline-viewer url="https://prod.spline.design/uP3F5wChqGJeEgEG/scene.splinecode"></spline-viewer> -->
<template>
    <Head title="Welcome" />

    <!-- component -->
    <header class="bg-snow dark:bg-oynx">
        <div class="container mx-auto px-4 py-1 flex justify-between items-center">
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
                    class="bg-transparent uppercase font-bold text-sm p-4 mr-4 flex justify-around w-full"
                    name=""
                    id=""
                >
                    <a class="text-oynx rounded-full dark:text-snow font-bold cook dark:cook py-2 px-3" href="">
                        <p>Be a Cook</p>
                    </a>
                    <a class="text-oynx rounded-full dark:text-snow font-bold cook dark:cook py-2 px-3" href="">
                        <p>Be a Cook</p>
                    </a>
                    <a class="text-oynx rounded-full dark:text-snow font-bold cook dark:cook py-2 px-3" href="">
                        <p>Be a Cook</p>
                    </a>
                </div>
                <!-- <div class="divcontainer relative w-70/100">
                    <input
                        required=""
                        type="text"
                        name="text"
                        class="input w-full h-full p-4"
                    />
                    <svg
                        class="ml-auto h-5 px-4 absolute right-0 top-3 text-gray-500 svg-inline--fa fa-search fa-w-16 fa-9x"
                        aria-hidden="true"
                        focusable="false"
                        data-prefix="far"
                        data-icon="search"
                        role="img"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"
                    >
                        <path
                            fill="currentColor"
                            d="M508.5 468.9L387.1 347.5c-2.3-2.3-5.3-3.5-8.5-3.5h-13.2c31.5-36.5 50.6-84 50.6-136C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c52 0 99.5-19.1 136-50.6v13.2c0 3.2 1.3 6.2 3.5 8.5l121.4 121.4c4.7 4.7 12.3 4.7 17 0l22.6-22.6c4.7-4.7 4.7-12.3 0-17zM208 368c-88.4 0-160-71.6-160-160S119.6 48 208 48s160 71.6 160 160-71.6 160-160 160z"
                        ></path>
                    </svg>
                </div> -->
            </div>

            <!-- buttons -->
            <nav class="contents">
                <ul class="ml-4 xl:w-48 flex items-center justify-end">
                    <li
                        class="ml-2 text-nowrap lg:mr-4 relative inline-block dark:bg-oynx rounded-full py-2 px-4 cook dark:cook"
                    >
                        <a class="text-oynx dark:text-snow font-bold" href="">
                            <p>Be a Cook</p>
                        </a>
                    </li>
                    <li
                        class="ml-2 lg:mx-4 relative inline-block bg-oynx rounded-full p-1 profile dark:profile"
                    >
                        <a class="" href="">
                            <font-awesome-icon
                                icon="user"
                                class="h-3 lg:h-4 p-2 text-polynesian dark:text-lighred svg-inline--fa fa-user fa-w-14 fa-9x"
                            />
                        </a>
                    </li>
                    <li
                        class="ml-2 lg:mr-4 relative inline-block bg-oynx rounded-full p-1 profile dark:profile"
                    >
                        <a class="" href="">
                            <font-awesome-icon
                                icon="globe"
                                class="h-3 lg:h-4 p-2 text-polynesian dark:text-lighred svg-inline--fa fa-user fa-w-14 fa-9x"
                            />
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <hr />
    </header>
    <!-- 
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-white"
    >
        <div
            v-if="canLogin"
            class="sm:fixed sm:top-0 sm:end-0 p-6 text-end z-10"
        >
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Dashboard</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ms-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Register</Link
                >
            </template>
        </div>

        <div class="relative mx-auto overflow-hidden h-screen w-screen">
            <div
                class="absolute right-0 bottom-0 h-16 w-40 bg-center bg-snow dark:bg-oynx z-50"
            ></div>

            <iframe
                src="https://my.spline.design/untitled-22ece4253c983291af7e559585416b64/"
                class="absolute w-full h-full"
            ></iframe> 

            <div class="m-auto flex items-center h-full px-6 lg:p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <div>
                        <h2
                            class="mt-6 text-xl font-semibold text-gray-900 dark:text-white"
                        >
                            Documentation
                        </h2>

                        <p
                            class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed"
                        >
                            Laravel has wonderful documentation covering every
                            aspect of the framework. Whether you are a newcomer
                            or have prior experience with Laravel, we recommend
                            reading our documentation from beginning to end.
                        </p>
                        <button
                            class="button2 bg-snow dark:button2 mt-5 transition-all duration-300 delay-75"
                        >
                            Hover me
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
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
