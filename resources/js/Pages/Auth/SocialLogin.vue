<template>
    <div
        class="bookmarkBtn w-full cursor-pointer overflow-hidden bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm flex items-center rounded-2 duration-300"
    >
        <span
            class="IconContainer ml-3 my-1 w-[40px] h-[40px] flex items-center justify-center overflow-hidden z-[2] duration-300"
        >
        <slot name="logo"/>
        </span>
        <p class="text text-sm text-oynx dark:text-snow w-full h-full flex items-center justify-center duration-300 ">
       <slot name="name"/>
        </p>
    </div>
</template>

<style scoped>
.bookmarkBtn:hover .IconContainer {
    width: 100%;
    transition-duration: 0.3s;
}

.bookmarkBtn:hover .text {
    transform: translate(10px);
    width: 0;
    font-size: 0;
    transition-duration: 0.3s;
}

.bookmarkBtn:active {
    transform: scale(0.95);
    transition-duration: 0.3s;
}
</style>
