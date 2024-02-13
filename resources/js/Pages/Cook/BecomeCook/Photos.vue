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
                                    >
                                        <div class="relative flex">
                                            <input
                                                type="file"
                                                multiple
                                                accept="image/*"
                                                @change="previewImages"
                                                class="cursor-pointer relative block opacity-0 w-full h-full p-20 z-50"
                                            />
                                            <div
                                                class="absolute top-0 right-0 left-0 bottom-0 m-auto flex flex-col justify-center w-full p-4 mb-0 list-none rounded-xl"
                                            >
                                                <font-awesome-icon
                                                    class="text-4xl group-action-text"
                                                    icon="images"
                                                />
                                                <div
                                                    v-if="imagePreviews.length"
                                                    class="mt-4 m-auto flex flex-wrap justify-center w-full p-4 mb-0 list-none rounded-xl"
                                                >
                                                    <p
                                                        class="font-semibold text-center px-4 py-2 transition-colors ease-in-out rounded-lg group-action-text"
                                                    >
                                                        <span
                                                            class="lg:text-xl leading-normal"
                                                            >Drag to rearrange
                                                            the images (the
                                                            first image will be
                                                            used as the cover
                                                            page )</span
                                                        >
                                                    </p>
                                                </div>

                                                <div v-else class="pt-2 w-full">
                                                    <p
                                                        class="font-semibold text-center px-4 py-2 transition-colors ease-in-out rounded-lg group-action-text"
                                                    >
                                                        <span
                                                            class="lg:text-xl leading-normal"
                                                            >Click or Drag
                                                            (Minimum (3)) photos
                                                            to the box</span
                                                        >
                                                    </p>
                                                </div>
                                                <div
                                                    v-if="errors.length"
                                                    class="m-auto flex flex-wrap justify-center w-full px-6 mb-0 list-none rounded-xl"
                                                >
                                                    <ul>
                                                        <li
                                                            v-for="error in errors"
                                                            :key="error"
                                                        >
                                                            {{ error }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Image preview container -->

                                        <div
                                            v-if="imagePreviews.length"
                                            ref="imageContainer"
                                            class="mt-4 m-auto justify-center w-full p-4 mb-0 list-none grid grid-cols-2 md:grid-cols-5 gap-5 lg:gap-7 lg:px-10 rounded-xl"
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
                                                    :src="preview.src"
                                                    :alt="preview.src"
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
                    :href="`/become-a-cook/${Meal.id}/meal-title`"
                    class="font-semibold"
                >
                    <button class="relative group">
                        <span class="hover-underline-animation"> Back </span>
                    </button>
                </Link>
            </div>
        </template>
        <template #mainbtn>
            <button @click="createNewPhotos" class="btn2span group">
                <span class="next-span">Next Step</span>
                <span class="with-span">We're with you</span>
            </button>
        </template>
    </BecomeCook>
</template>

<script>
import axios from "axios";
export default {
    props: {
        Meal: Object,
        mealPhotos: Object,
    },
    data() {
        return {
            imagePreviews: [],
            imageFiles: [],
            minSize: 500, // Minimum image size (in pixels)
            maxSize: 3000, // Maximum image size (in pixels)
            dragIndex: null, // Array to hold image preview URLs
            errors: [],
        };
    },
    created() {
        this.fetchImages(); // Fetch images from the backend when the component is created
    },
    methods: {
        async previewImages(event) {
            this.imageFiles = event.target.files;
            if (this.imageFiles) {
                if (this.imageFiles.length < 3) {
                    // Display an error message or prevent further processing
                    alert("Please upload at least three pictures.");
                    return;
                }
                if (this.imageFiles.length > 10) {
                    // Display an error message or prevent further processing
                    alert("!0 is the limit pictures.");
                    return;
                }

                const validImages = [];
                const invalidImages = [];
                for (let i = 0; i < this.imageFiles.length; i++) {
                    const file = this.imageFiles[i];
                    if (file.type.startsWith("image/")) {
                        const img = new Image();
                        img.src = URL.createObjectURL(file);

                        await new Promise((resolve) => {
                            img.onload = () => {
                                if (
                                    img.width >= this.minSize &&
                                    img.height >= this.minSize &&
                                    img.width <= this.maxSize &&
                                    img.height <= this.maxSize
                                ) {
                                    this.imagePreviews.push(img);
                                    validImages.push(file);
                                } else {
                                    this.errors.push(
                                        `Image ${
                                            i + 1
                                        } dimensions do not meet requirements (min: ${
                                            this.minSize
                                        }px, max: ${this.maxSize}px).`
                                    );

                                    invalidImages.push(file);
                                }
                                setTimeout(() => {
                                    this.errors = [];
                                }, 10000);
                                resolve();
                            };
                        });
                    } else {
                        this.errors.push(`File ${i + 1} is not an image.`);
                        invalidImages.push(file);
                    }
                }

                // Update this.imageFiles with valid images
                this.imageFiles = validImages;

                // Display an error message for invalid images
                if (invalidImages.length > 0) {
                }
            }
        },

        fetchImages() {
            this.imagePreviews = this.mealPhotos.map((image) => ({
                src: `storage/${image.meal_photo_path}`, // Assuming your image object has a 'url' property
                id: image.id, // Assuming your image object has an 'id' property
            }));
        },

        dragStart(index, event) {
            event.dataTransfer.setData("text/plain", index);
            this.dragIndex = index;
        },
        removeImage(index) {
            this.imagePreviews.splice(index, 1);
            this.imageFiles.splice(index, 1);
        },

        drop(index, event) {
            event.preventDefault();
            const data = event.dataTransfer.getData("text/plain");
            const fromIndex = parseInt(data);
            if (fromIndex !== index) {
                const temp = this.imagePreviews[fromIndex];
                const file = this.imageFiles[fromIndex];
                this.imagePreviews.splice(fromIndex, 1);
                this.imagePreviews.splice(index, 0, temp);
                this.imageFiles.splice(fromIndex, 1);
                this.imageFiles.splice(index, 0, file);
            }

            this.dragIndex = null;
        },
        createNewPhotos() {
            const formData = new FormData();
            formData.append("meal_id", this.Meal.id);
            for (let i = 0; i < this.imageFiles.length; i++) {
                formData.append("images[]", this.imageFiles[i]);
            }
            axios
                .post("/meal_photos/", formData, {
                    meal_id: this.Meal.id,
                    // other meal data...
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then((response) => {
                    console.log("Images uploaded successfully:", response.data);
                    // Handle the response to update UI or perform other actions
                })
                .catch((error) => {
                    console.error("Error uploading images:", error);
                });
        },
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
