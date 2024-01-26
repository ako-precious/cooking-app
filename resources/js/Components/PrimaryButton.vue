<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <!-- <button class="inline-flex items-center  bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
        
    </button> -->
    <button :type="type" class="button2 relative px-4 py-2 overflow-hidden dark:button2 mt-5 bg-snow transition-all duration-300 delay-75"><slot /></button>
</template>
<style scoped>
.button2 {
    display: inline-block;
    overflow: hidden;
    z-index: 1;
    cursor: pointer;
    font-size: 18px;
    border-radius: 0.5em;    
    box-shadow: 6px 6px 12px #c5c5c5, -6px -6px 12px #ffffff;
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
    background-color: #1B998B;
    border-radius: 50%;
    display: block;
    transition: all 0.5s 0.1s cubic-bezier(0.55, 0, 0.1, 1);
    z-index: -1;
}

.button2:hover {
    color: #ffe9f3;
    border: 1px solid #1B998B;
    box-shadow:none;
}

.button2:hover:before {
    top: -35%;
    background-color: #1B998B;
    transform: translateX(-50%) scaleY(1.3) scaleX(0.8);
}

.button2:hover:after {
    top: -45%;
    background-color: #1B998B;
    transform: translateX(-50%) scaleY(1.3) scaleX(0.8);
}

@media (prefers-color-scheme: dark) {
    .dark\:button2 {
        color: #ffe9f3;
        background: linear-gradient(145deg, #2b312e, #333a37);
        box-shadow: 18px 18px 36px #1f2321, -18px -18px 36px #414945;
    }

    .dark\.button2:active {
        color: #303633;
        box-shadow: inset 4px 4px 12px  #303633, inset -4px -4px 12px rgb(0, 0, 0);
    }    
}
</style>