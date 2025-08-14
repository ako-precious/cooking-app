<template>
    <th
        class="relative px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-snow/40 dark:text-snow  border-b-solid tracking-none whitespace-nowrap text-oynx opacity-70"
    >
        <div class="flex justify-between items-center">
            <slot name="title"></slot>
            <div class="pl-3 flex flex-col justify items-center">
                <slot name="symbols"></slot>
            </div>
        </div>
    </th>
</template>

<script>
export default {};
</script>
