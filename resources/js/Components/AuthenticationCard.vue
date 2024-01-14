<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-snow dark:bg-oynx"
    >
        <div>
            <slot name="logo" />
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 card dark:card shadow-lg overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>

<style scoped>
.card {
    background: linear-gradient(145deg, #e3dedf, #ffffff);
    box-shadow: 25px 25px 50px #cac6c6, -25px -25px 50px #ffffff;
}
.card:hover {
    background: linear-gradient(145deg, #e3dedf, #ffffff);
    box-shadow: -25px -25px 50px #a19e9f, 25px 25px 50px #ffffff;
}
@media (prefers-color-scheme: dark) {
    .dark\:card {
        background: linear-gradient(145deg, #2b312e, #333a37);
        box-shadow: 25px 25px 50px #262b29, -25px -25px 50px #3a413d;
    }
    .dark\:card:hover {
        /* border-radius: 50px; */
        background: linear-gradient(145deg, #2b312e, #333a37);
        box-shadow: -25px -25px 50px #262b29, 25px 25px 50px #3a413d;
    }
}
</style>
