<script setup>
import { Head, Link } from "@inertiajs/vue3";

import BecomeCook from "./BecomeCook.vue";
</script>

<template>
    <BecomeCook>
        <template #info>
            <div class="container relative mx-auto overflow-hidden">
                <div
                    class="m-auto flex flex-col max-w-[1000px] justify-center h-full px-6 lg:pb-20 w-full"
                >
                    <div class="py-5 lg:pb-12 text-center">
                        <h1
                            class="font-semibold text-2xl lg:text-4xl text-oynx dark:text-snow"
                        >
                            Share photos of your delicious creation!
                        </h1>
                    </div>
                    <div class="lg:w-full">
                        <div class="flex flex-col w-full">
                            <div
                                class="flex justify-center item-center lg:gap-10 lg:px-10"
                            >
                                <div class="w-full max-w-full py-2 fle">
                                    <!-- <div
                                        class="relative flex min-w-0 break-words w-full py-4 shadow-reverse group rounded-2xl bg-clip-border"
                                    >
                                    <input type="file" multiple class="cursor-pointer relative block opacity-0 w-full h-full p-20 z-50">
                                        <div
                                            class="absolute top-0 right-0 left-0 bottom-0 m-auto flex lg:flex-col justify-center flex-wrap w-full p-4 mb-0 list-none rounded-xl"
                                        >
                                            <font-awesome-icon
                                                class="text-4xl group-action-text"
                                                 icon="images" />
                                           
                                            <div></div>
                                            <div class="pt-2 w-full">
                                                <p
                                                    class="font-semibold text-center px-4 py-2 transition-colors ease-in-out rounded-lg group-action-text"
                                                >
                                                    <span
                                                        class="lg:text-xl leading-normal"
                                                        > Click or Drag (Minimum (3)) photos to the box</span
                                                    >
                                                </p>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div
                                        class="relative flex flex-col min-w-0 break-words w-full py-4 shadow-reverse group rounded-2xl bg-clip-border"
                                    > <div class="relative flex">
                                        <input
                                            type="file"
                                            multiple
                                            accept="image/*"
                                            @change="previewImages"
                                            class="cursor-pointer relative block opacity-0 w-full h-full p-20 z-50"
                                        /><div
                                            
                                            class="absolute top-0 right-0 left-0 bottom-0 m-auto flex lg:flex-col justify-center flex-wrap w-full p-4 mb-0 list-none rounded-xl"
                                        >
                                            <font-awesome-icon
                                                class="text-4xl group-action-text"
                                                icon="images"
                                            />
                                            <div  v-if="imagePreviews.length"
                                            
                                            class="mt-4  m-auto flex flex-wrap justify-center w-full p-4 mb-0 list-none rounded-xl">
                                            <p
                                                    class="font-semibold text-center px-4 py-2 transition-colors ease-in-out rounded-lg group-action-text"
                                                >
                                                    <span
                                                        class="lg:text-xl leading-normal"
                                                        >Drag to rearrange the images (the first image will be used as the cover page )</span
                                                    >
                                                </p>
                                        </div>
                                        
                                            <div v-else class="pt-2 w-full">
                                                <p
                                                    class="font-semibold text-center px-4 py-2 transition-colors ease-in-out rounded-lg group-action-text"
                                                >
                                                    <span
                                                        class="lg:text-xl leading-normal"
                                                        >Click or Drag (Minimum
                                                        (3)) photos to the
                                                        box</span
                                                    >
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                        <!-- Image preview container -->
                                        <div class="grid grid-cols-3  md:grid-cols-5 gap-5 lg:gap-8 lg:px-10">

                                        </div>
                                        <div
                                            v-if="imagePreviews.length"
                                            ref="imageContainer"
                                            class="mt-4  m-auto  justify-center w-full p-4 mb-0 list-none grid grid-cols-2  md:grid-cols-5 gap-5 lg:gap-7 lg:px-10 rounded-xl"
                                        >
                                            <div
                                                v-for="(
                                                    preview, index
                                                ) in imagePreviews"
                                                :key="index"
                                                class="relative"
                                                draggable
                                                @dragstart="
                                                    dragStart(index, $event)
                                                "
                                                @dragover.prevent
                                                @drop="drop(index, $event)"
                                            >
                                            <p
                                                    class="absolute top-0 right-0 bg-snow dark:bg-oynx cursor-pointer p-1 px-2"
                                                    @click="removeImage(index)"
                                                >
                                                    <font-awesome-icon
                                                        icon="fa-solid fa-close"
                                                        class="text-lighred text-sm"
                                                    />
                                                </p>
                                                <img
                                                    :src="preview"
                                                    alt="Image Preview"
                                                    class="w-full h-full object-cover rounded"
                                                />
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template #progressbar>
            <div class="h-1 w-full bg-neutral-400 dark:bg-neutral-600">
                <div
                    class="h-1 bg-persian transition-all duration-250 delay-75"
                    style="width: 10%"
                ></div>
            </div>
        </template>
        <template #backbtn>
            <div class="float-left ml-8 h-full flex items-center">
                <Link
                    :href="`/become-a-cook/ingredients`"
                    class="font-semibold"
                >
                    <button class="cta">
                        <span
                            class="hover-underline-animation relative tracking-wide text-oynx dark:text-snow pb-1 after:bg-oynx after:dark:bg-snow"
                        >
                            Back
                        </span>
                    </button>
                </Link>
            </div>
        </template>
        <template #mainbtn>
            <Link :href="`/become-a-cook/meal-title`" class="float-right mr-8">
                <button
                    class="bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-sm dark:shadow-oynx-sm mt-5 button type1 text-xs"
                ></button> </Link
        ></template>
    </BecomeCook>
</template>

<script>
export default {
    data() {
        return {
            imagePreviews: [], // Array to hold image preview URLs
        };
    },
    methods: {
    previewImages(event) {
      this.imagePreviews = [];
      const files = event.target.files;
      if (files) {
        for (let i = 0; i < files.length; i++) {
          const file = files[i];
          if (file.type.startsWith("image/")) {
            const reader = new FileReader();
            reader.onload = (e) => {
              this.imagePreviews.push(e.target.result);
            };
            reader.readAsDataURL(file);
          }
        }
      }
    },
    dragStart(index, event) {
      event.dataTransfer.setData("text/plain", index);
      this.dragIndex = index;
    },
    removeImage(index) {
        this.imagePreviews.splice(index, 1);
        },

    drop(index, event) {
      event.preventDefault();
      const data = event.dataTransfer.getData("text/plain");
      const fromIndex = parseInt(data);
      if (fromIndex !== index) {
        const temp = this.imagePreviews[fromIndex];
        this.imagePreviews.splice(fromIndex, 1);
        this.imagePreviews.splice(index, 0, temp);
      }
      this.dragIndex = null;
    },
    createNewMeal() {
      axios.post('/meal_photos' , {
        images: this.imagePreviews, // Send the image previews array
        // other meal data...
      })
      .then(response => {
        // Handle response...
      })
      .catch(error => {
        // Handle error...
      });
    }

  },
};
</script>

<style scoped>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}

.hover-underline-animation:after {
    content: "";
    position: absolute;
    width: 100%;
    transform: scaleX(0);
    height: 2px;
    bottom: 0;
    left: 0;
    transform-origin: bottom right;
    transition: transform 0.25s ease-out;
}

.cta:hover .hover-underline-animation:after {
    transform: scaleX(1);
    transform-origin: bottom left;
}

/* the design for the next button */
.button {
    height: 50px;
    width: 165px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: all 0.5s ease-in-out;
}

.button:hover {
    box-shadow: 0.5px 0.5px 150px #252525;
}

.type1::after {
    content: "We're with you";
    height: 50px;
    width: 165px;
    background-color: #004e98;
    color: #fff;
    position: absolute;
    top: 0%;
    left: 0%;
    transform: translateY(50px);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.5s ease-in-out;
}

.type1::before {
    content: "Next Step";
    height: 50px;
    width: 165px;
    /* background-color: #fff; */
    color: #004e98;
    position: absolute;
    top: 0%;
    left: 0%;
    transform: translateY(0px) scale(1.2);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.5s ease-in-out;
}

.type1:hover::after {
    transform: translateY(0) scale(1.2);
}

.type1:hover::before {
    transform: translateY(-50px) scale(0) rotate(120deg);
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
    animation: fade-in 0.7s ease-in;
}
</style>
