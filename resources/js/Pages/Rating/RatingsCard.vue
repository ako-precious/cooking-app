<script setup>
import { Head, Link } from "@inertiajs/vue3";
import axios from "axios";
</script>

<template>
  
          
            <div class="row-span-1 w-1/2 sm:1/3  md:w-full rounded-3">
                <div class="h-full m-auto md:w-1/2 rounded-3 group">
                    <div class="flex items-center">
                        <slot name="img" />
                        <div>
                            <h1
                                class="font-semibold text-lg lg:text-xl text-oynx dark:text-snow"
                            > <slot name="title"/>
                            </h1>
                            <p
                                class="font-bold text-sm lg:text-base text-oynx dark:text-snow"
                            > <slot name='rating'/>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
          
    


</template>

