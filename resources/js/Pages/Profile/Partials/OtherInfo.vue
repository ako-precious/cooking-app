<script setup></script>

<template>
    <form class="p-10 lg:w-3/5 m-auto shadow-reverse bg-snow dark:bg-oynx">
        <div class="mb-6">
            <label
                for="password"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                >Can you share a brief background about yourself, including your
                cooking experience?</label
            >
            <textarea
                id="message"
                rows="4"
                class="bg-transparent border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-2 focus:ring-fuchsia-50 focus:border-fuchsia-300 block w-full p-2.5 dark:text-white"
                placeholder="Leave a comment..."
            ></textarea>
        </div>
        <div class="mb-6">
            <label
                for="email"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                >What inspired you to start cooking, and what's your favorite
                dish to prepare?
            </label>
            <textarea
                id="message"
                rows="4"
                class="bg-transparent border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-2 focus:ring-fuchsia-50 focus:border-fuchsia-300 block w-full p-2.5 dark:text-white"
                placeholder="Leave a comment..."
            ></textarea>
        </div>
        <div class="mb-6">
            <label
                for="password"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                >How do you ensure food safety and hygiene in your cooking
                process?
            </label>
            <textarea
                id="message"
                rows="4"
                class="bg-transparent border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-2 focus:ring-fuchsia-50 focus:border-fuchsia-300 block w-full p-2.5 dark:text-white"
                placeholder="Leave a comment..."
            ></textarea>
        </div>
        <div class="flex items-start mb-6">
            <div class="flex items-center h-5">
                <input
                    id="remember"
                    aria-describedby="remember"
                    type="checkbox"
                    class="w-5 h-5 bg-transparent rounded border border-gray-300 focus:ring-0 checked:bg-dark-900"
                    required=""
                />
            </div>
            <div class="ml-3 text-sm">
                <label
                    for="remember"
                    class="font-medium text-gray-900 dark:text-gray-300"
                    >Remember me</label
                >
            </div>
        </div>
        <button
            type="submit"
            class="text-white bg-gradient-to-br from-pink-500 to-voilet-500 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 text-center inline-flex items-center shadow-md shadow-gray-300 dark:shadow-gray-900 hover:scale-[1.02] transition-transform"
        >
            Submit
        </button>
    </form>
</template>
