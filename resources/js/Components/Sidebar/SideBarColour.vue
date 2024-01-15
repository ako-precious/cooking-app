<template>
      <hr
            class="h-px mx-0 my-1 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
        />

        <!-- Sidenav Type -->
        <div class="mt-4">
            <h6 class="mb-0 dark:text-white">Sidenav Type</h6>
            <p class="text-sm leading-normal dark:text-white dark:opacity-80">
                Choose between 2 different sidenav types.
            </p>
        </div>
        <div class="flex">
            <slot>Default</slot>
        </div>
    
</template>
