<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
</script>
<template>
    <div class="flex items-center justify-center min-h-screen">
        <div class="shadow-small rounded-lg p-8 max-w-lg w-full text-oynx dark-snow">
            <div class="text-center mb-8">
                <img src="/images/verified.png" alt="currencyfair logo" class="mx-auto mb-4" />
                <h2 class="text-2xl font-semibold">Verify your Identity</h2>
                <p>Upload a picture or scan for 2 separate identity documents below</p>
            </div>
            <div class="border-b mb-8">
                <div class="flex justify-center">
                    <button :class="{'border-persian  border-b-2': show === 'prev'}" class="py-2 px-4 any-link focus:outline-none" @click="show = 'prev'">
                        Photo Identification
                    </button>
                    <button :class="{'border-persian  border-b-2': show === 'next'}" class="py-2 px-4 any-link focus:outline-none" @click="show = 'next'" :disabled="!imageSrc">
                        Food Handling Certificate
                    </button>
                </div>
            </div>
            <div :class="{ hidden: show !== 'prev' }">
                <div class="mb-8">
                    <h3 class="text-lg font-semibold mb-4">Upload Photo Identification</h3>
                    <div class="border-2 border-dashed border-gray-300 p-4 rounded-lg text-center">
                        <input type="file" class="hidden" id="file-upload" @change="handleFileUpload" ref="fileInput" />
                        <label for="file-upload" class="cursor-pointer">
                            <div v-if="imageSrc" class="mt-4">
                                <img :src="imageSrc" alt="Image Preview" class="w-full h-auto rounded-lg shadow-md" />
                                <p class="text-green-500 mt-2">File size is valid.</p>
                            </div>
                            <div v-else>
                                <div class="flex items-center justify-center mb-4">
                                    <img src="/images/id-card.png" alt="uploaded file" class="mx-auto" />
                                </div>
                                <p class="text-gray-500">
                                    Drag 'file here to upload or <span class="text-blue-500">select a file</span> from your device
                                </p>
                                <p class="text-gray-400">Images Only, maximum file size - 4MB</p>
                            </div>
                            <p v-if="errorMessage" class="text-red-500 mt-2">{{ errorMessage }}</p>
                        </label>
                    </div>
                </div>
                <div class="flex flex-col">
                    <h4 class="text-md font-semibold mb-2">Your document must be:</h4>
                    <ul class="list-disc list-inside">
                        <li>Student ID card</li>
                        <li>Clear and readable</li>
                    </ul>
                    <a href="https://www.georgiancollege.ca/student-life/campus-services/onecard/#onecard-information" class="text-persian mt-4 inline-block">See an example image with requirements</a>
                    <div class="flex justify-between flex-row-reverse">
                        <PrimaryButton @click="show = 'next'" :disabled="!imageSrc">Next</PrimaryButton>
                    </div>
                </div>
            </div>
            <div :class="{ hidden: show !== 'next' }">
                <div class="mb-8">
                    <h3 class="text-lg font-semibold mb-4">Upload Food Handling Certificate</h3>
                    <div class="border-2 border-dashed border-gray-300 p-4 rounded-lg text-center">
                        <input type="file" class="hidden" id="file-upload2" @change="handleFileUpload2" ref="fileInput2" />
                        <label for="file-upload2" class="cursor-pointer">
                            <div v-if="imageSrc2" class="mt-4">
                                <img :src="imageSrc2" alt="Image Preview" class="w-full h-auto rounded-lg shadow-md" />
                                <p class="text-green-500 mt-2">File size is valid.</p>
                            </div>
                            <div v-else>
                                <div class="flex items-center justify-center mb-4">
                                    <img src="/images/id-card.png" alt="uploaded file" class="mx-auto" />{{ imageSrc2 }}
                                </div>
                                <p class="text-gray-500">
                                    Drag 'file here to upload or <span class="text-blue-500">select a file</span> from your device
                                </p>
                                <p class="text-gray-400">Images Only, maximum file size - 4MB</p>
                            </div>
                            <p v-if="errorMessage2" class="text-red-500 mt-2">{{ errorMessage2 }}</p>
                        </label>
                    </div>
                </div>
                <div class="flex flex-col">
                    <h4 class="text-md font-semibold mb-2">Your document must be:</h4>
                    <ul class="list-disc list-inside">
                        <li>A certificate approved by Ontario</li>
                        <li>A certificate with an expiry date that is in future date</li>
                    </ul>
                    <a href="https://www.georgiancollege.ca/student-life/campus-services/onecard/#onecard-information" class="text-persian mt-4 inline-block">See an example image with requirements</a>
                    <div class="flex justify-between items-center">
                        <button class="relative group mt-5" @click="show = 'prev'">
                            <span class="hover-underline-animation text-lg"> Prev </span>
                        </button>
                        <PrimaryButton @click="submitForm" :disabled="!imageSrc2">Complete</PrimaryButton>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            imageSrc: null,
            imageSrc2: null,
            errorMessage: null,
            errorMessage2: null,
            show: "prev",
        };
    },
    methods: {
        handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.validateFile(file, 'imageSrc', 'errorMessage');
            }
        },
        handleFileUpload2(event) {
            const file = event.target.files[0];
            if (file) {
                this.validateFile(file, 'imageSrc2', 'errorMessage2');
            }
        },
        validateFile(file, imageSrcProp, errorMessageProp) {
            const maxSizeInMB = 4;
            const maxSizeInBytes = maxSizeInMB * 1024 * 1024;

            if (!file.type.startsWith("image/")) {
                this[errorMessageProp] = "Only image files are allowed.";
                this[imageSrcProp] = null;
            } else if (file.size > maxSizeInBytes) {
                this[errorMessageProp] = `File size should be less than ${maxSizeInMB} MB.`;
                this[imageSrcProp] = null;
            } else {
                this[errorMessageProp] = null;
                this.previewImage(file, imageSrcProp);
            }
        },
        previewImage(file, imageSrcProp) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this[imageSrcProp] = e.target.result;
            };
            reader.readAsDataURL(file);
        },
        submitForm() {
            const formData = new FormData();
            formData.append('photo_identification', this.$refs.fileInput.files[0]);
            formData.append('food_handling_certificate', this.$refs.fileInput2.files[0]);

            axios.post('/api/upload', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then(response => {
                console.log('Files uploaded successfully:', response.data);
                // Handle success response
            })
            .catch(error => {
                console.error('Error uploading files:', error);
                // Handle error response
            });
        }
    }
};
</script>
