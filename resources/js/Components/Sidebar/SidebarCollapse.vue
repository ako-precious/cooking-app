<template>
    <hr
        class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
    />
    <div
        class="items-center block w-full h-auto grow basis-full"
        id="sidenav-collapse-main"
    >
        <ul class="flex flex-col pl-0 mb-0 list-none">
            <slot>Default</slot>

        </ul>
    </div>
</template>

