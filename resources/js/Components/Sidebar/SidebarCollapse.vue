<template>
    <hr
        class="h-px mb-2 bg-transparent bg-gradient-to-r from-transparent via-oynx/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-snow dark:to-transparent "
    />
    <div
        class="items-center block overflow-y-auto h-full relative disable-scrollbars"
        id="sidenav-collapse-main"
    >
        <ul class="flex flex-col pl-0 mb-0 list-none">
            <slot>Default</slot>

        </ul>
    </div>
</template>

