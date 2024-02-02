<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-snow dark:bg-oynx"
    >
        <div>
            <slot name="logo" />
        </div>

        <div
            class="w-full sm:max-w-md lg:max-w-lg mt-6 px-6 py-4 shadow-small overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>

<style scoped>

</style>
