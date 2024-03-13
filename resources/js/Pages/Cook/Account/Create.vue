<script setup>
import { Head, Link } from "@inertiajs/vue3";
import TableHeadVue from "@/Components/Table/TableHead.vue";
import TableRow from "./TableRow.vue";
import HeaderVue from "../Header.vue";
import  CaretDown  from "@/Components/CaretDown.vue";
import  CaretUp  from "@/Components/CaretUp.vue";
</script>

<template>
      <Head title="Menu" />
    <div
        class="relative sm:flex sm:justify-center sm:items-center  bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-white"
    >
        <div class="container relative mx-auto overflow-hidden">

            <HeaderVue> </HeaderVue>  
            <div
                class="m-auto flex flex-col  justify-center h-full p-6 lg:pb-20 w-full"
            >
            
                <div class="lg:w-full">
                    <div class="flex flex-col w-full">
                        <div class="flex justify-between items-center">
                          
                            <div class="p-2 flex">
                                <Link :href="`/become-a-cook/overview`">
                                    <button
            class="shadow-md  rounded-md cursor-pointer w-[150px] h-[50px] text-oynx dark:text-snow font-semibold border-none flex justify-center items-center"
        >   
            <span class="span-mother flex overflow-hidden">
            
                <span>Cr</span>
                <span>ea</span>
                <span>t</span>
                <span> e M</span>
                <span>ea</span>
                <span>l <font-awesome-icon
                                                icon="plus"/></span>
            </span>
            <span class="span-mother2">
                <span>Cr</span>
                <span>ea</span>
                <span>t</span>
                <span> e M</span>
                <span>ea</span>
                <span>l <font-awesome-icon
                                                icon="plus"/></span>
            </span>
        </button></Link>
                            </div>

                        </div>
                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: {
        menu: Object,
    },
  
};
</script>


<style scoped>
button:hover .span-mother {
    position: absolute;
}

button:hover .span-mother span {
    transform: translateY(1.3em);
}

button .span-mother span:nth-child(1) {
    transition: 0.2s;
}

button .span-mother span:nth-child(2) {
    transition: 0.3s;
}

button .span-mother span:nth-child(3) {
    transition: 0.4s;
}

button .span-mother span:nth-child(4) {
    transition: 0.5s;
}

button .span-mother span:nth-child(5) {
    transition: 0.6s;
}

button .span-mother span:nth-child(6) {
    transition: 0.7s;
}
button .span-mother2 {
    display: flex;
    position: absolute;
    overflow: hidden;
}

button .span-mother2 span {
    transform: translateY(-1.5em);
}

button:hover .span-mother2 span {
    transform: translateY(0);
}

button .span-mother2 span {
    transition: 0.2s;
}

button .span-mother2 span:nth-child(2) {
    transition: 0.3s;
}

button .span-mother2 span:nth-child(3) {
    transition: 0.4s;
}

button .span-mother2 span:nth-child(4) {
    transition: 0.5s;
}

button .span-mother2 span:nth-child(5) {
    transition: 0.6s;
}

button .span-mother2 span:nth-child(6) {
    transition: 0.7s;
}

@keyframes fade-in {
    from {
        opacity: 0;
        bottom: -10rem;
    }
    to {
        opacity: 1;
        bottom: 0;
    }
}

.animate-fade-in {
    animation: fade-in 0.5s ease-in;
}
</style>
