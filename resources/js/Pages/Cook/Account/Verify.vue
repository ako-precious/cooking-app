<template>
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg w-full">
            <div class="text-center mb-8">
                <img
                    src="/images/verified.png"
                    alt="currencyfair logo"
                    class="mx-auto mb-4"
                />
                <h2 class="text-2xl font-semibold">Verify your Identity</h2>
                <p class="text-gray-600">
                    Upload a picture or scan for 2 separate identity documents
                    below
                </p>
            </div>
            <div class="border-b mb-8">
                <div class="flex justify-center">
                    <button
                        class="py-2 px-4 text-gray-600 hover:text-gray-800 focus:outline-none border-b-2 border-blue-500"
                    >
                        Photo Identification
                    </button>
                    <button
                        class="py-2 px-4 text-gray-600 hover:text-gray-800 focus:outline-none"
                    >
                        Food Handling Certificate
                    </button>
                </div>
            </div>
            <div class="mb-8">
                <h3 class="text-lg font-semibold mb-4">
                    Upload Photo Identification
                </h3>
                <div
                    class="border-2 border-dashed border-gray-300 p-4 rounded-lg text-center"
                >
                    <input
                        type="file"
                        class="hidden"
                        id="file-upload"
                        @change="handleFileUpload"
                        ref="fileInput"
                    />
                    <label for="file-upload" class="cursor-pointer">
                        <div v-if="imageSrc" class="mt-4">
                            <img
                                :src="imageSrc"
                                alt="Image Preview"
                                class="w-full h-auto rounded-lg shadow-md"
                            />
                            <p class="text-green-500 mt-2">
                                File size is valid.
                            </p>
                        </div>
                        <div v-else>
                            <div class="flex items-center justify-center mb-4">
                                <img
                                    src="/images/id-card.png"
                                    alt="uploaded file"
                                    class="mx-auto"
                                />
                            </div>
                            <p class="text-gray-500">
                                Drag 'file here to upload or
                                <span class="text-blue-500">select a file</span>
                                from your device
                            </p>
                            <p class="text-gray-400">
                                Images Only, maximum file size - 3MB
                            </p>
                        </div>
                        <p v-if="errorMessage" class="text-red-500 mt-2">
                            {{ errorMessage }}
                        </p>
                    </label>
                </div>
            </div>
            <div>
                <h4 class="text-md font-semibold mb-2">
                    Your document must be:
                </h4>
                <ul class="list-disc list-inside text-gray-600">
                    <li>Student ID card</li>
                    <!-- <li>Passport</li>
                    <li>Driver Licence</li>
                    <li>National ID card</li>
                    <li>Within its expiry date</li> -->
                </ul>
                <a
                    href="https://www.georgiancollege.ca/student-life/campus-services/onecard/#onecard-information"
                    class="text-persian mt-4 inline-block"
                    >See an example image with requirements</a
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            imageSrc: null,
            errorMessage: null,
        };
    },
    methods: {
        handleFileUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.validateFile(file);
            }
        },
        validateFile(file) {
            const maxSizeInMB = 4;
            const maxSizeInBytes = maxSizeInMB * 1024 * 1024;


            if (!file.type.startsWith('image/')) {
                this.errorMessage = "Only image files are allowed.";
                this.imageSrc = null;
            } else if (file.size > maxSizeInBytes) {
                this.errorMessage = `File size should be less than ${maxSizeInMB} MB.`;
                this.imageSrc = null;
            } else {
                this.errorMessage = null;
                this.previewImage(file);
            }
        },
        previewImage(file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.imageSrc = e.target.result;
            };
            reader.readAsDataURL(file);
        },
    },
};
</script>
