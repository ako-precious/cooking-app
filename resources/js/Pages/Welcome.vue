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

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen  bg-center bg-lavender  dark:bg-oynx selection:bg-red-500 selection:text-white"
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
                class="absolute right-0 bottom-0 h-16 w-40  bg-center bg-lavender  dark:bg-oynx z-50"
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
                        <button class="button2 dark:button2 mt-5  transition-all duration-300 delay-75">Hover me</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
.button2 {
    display: inline-block;
    transition: all 0.2s ease-in;
    position: relative;
    overflow: hidden;
    z-index: 1;
    /* color: #303633; */
    padding: 0.7em 1.7em;
    cursor: pointer;
    font-size: 18px;
    border-radius: 0.5em;
    background: #ffe9f3;
    border: 1px solid #ffe9f3;
    box-shadow: 6px 6px 12px #c5c5c5, -6px -6px 12px #ffffff;
}

@media (prefers-color-scheme: dark) {
    .dark\:button2 {
        color: #ffe9f3;
        background: #303633;
        border: 1px solid #303633;
        box-shadow: 6px 6px 12px #303633, -6px -6px 12px rgb(0, 0, 0);
    }

    .dark\.button2:active {
        color: #303633;
        box-shadow: inset 4px 4px 12px  #303633, inset -4px -4px 12px rgb(0, 0, 0);
    }
    
}

.button2:active {
    color: #666;
    box-shadow: inset 4px 4px 12px #c5c5c5, inset -4px -4px 12px #ffffff;
}

.button2:before {
    content: "";
    position: absolute;
    left: 50%;
    transform: translateX(-50%) scaleY(1) scaleX(1.25);
    top: 100%;
    width: 140%;
    height: 180%;
    background-color: rgba(0, 0, 0, 0.05);
    border-radius: 50%;
    display: block;
    transition: all 0.5s 0.1s cubic-bezier(0.55, 0, 0.1, 1);
    z-index: -1;
}

.button2:after {
    content: "";
    position: absolute;
    left: 55%;
    transform: translateX(-50%) scaleY(1) scaleX(1.45);
    top: 180%;
    width: 160%;
    height: 190%;
    background-color: #004e98;
    border-radius: 50%;
    display: block;
    transition: all 0.5s 0.1s cubic-bezier(0.55, 0, 0.1, 1);
    z-index: -1;
}

.button2:hover {
    color: #ffe9f3;
    border: 1px solid #004E98;
    box-shadow:none;
}

.button2:hover:before {
    top: -35%;
    background-color: #004E98;
    transform: translateX(-50%) scaleY(1.3) scaleX(0.8);
}

.button2:hover:after {
    top: -45%;
    background-color: #004E98;
    transform: translateX(-50%) scaleY(1.3) scaleX(0.8);
}
</style>
