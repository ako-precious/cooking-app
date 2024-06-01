<template>
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-lg w-full">
            <div class="text-center mb-8">
                <img src="https://via.placeholder.com/150x50?text=currencyfair" alt="currencyfair logo" class="mx-auto mb-4">
                <h2 class="text-2xl font-semibold">Verify your Identity</h2>
                <p class="text-gray-600">Upload a picture or scan of 2 separate identity documents below</p>
            </div>
            <div class="border-b mb-8">
                <div class="flex justify-center">
                    <button class="py-2 px-4 text-gray-600 hover:text-gray-800 focus:outline-none border-b-2 border-blue-500">Photo Identification</button>
                    <button class="py-2 px-4 text-gray-600 hover:text-gray-800 focus:outline-none">Proof of Address</button>
                </div>
            </div>
            <div class="mb-8">
                <h3 class="text-lg font-semibold mb-4">Upload Photo Identification</h3>
                <div class="border-2 border-dashed border-gray-300 p-4 rounded-lg text-center">
                    <input type="file" class="hidden" id="file-upload">
                    <label for="file-upload" class="cursor-pointer">
                        <div class="flex items-center justify-center mb-4">
                            <img src="https://via.placeholder.com/50?text=pdf" alt="uploaded file" class="mx-auto">
                        </div>
                        <p class="text-gray-500">Drag file here to upload or <span class="text-blue-500">select a file</span> from your device</p>
                        <p class="text-gray-400">JPG, PNG or PDF only, maximum file size - 5MB</p>
                    </label>
                </div>
            </div>
            <div>
                <h4 class="text-md font-semibold mb-2">Your document must be:</h4>
                <ul class="list-disc list-inside text-gray-600">
                    <li>A Government issued</li>
                    <li>Passport</li>
                    <li>Driver Licence</li>
                    <li>National ID card</li>
                    <li>Within its expiry date</li>
                </ul>
                <a href="#" class="text-blue-500 mt-4 inline-block">See an example image with requirements</a>
            </div>
        </div>
    </div>
</template>