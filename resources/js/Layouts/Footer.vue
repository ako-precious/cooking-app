<script>
export default {
    data() {
        return {
            currentYear: new Date().getFullYear(), // Get the current year using Date object
            appName: "Mymealni", // Get the current year using Date object
        };
    },
    mounted() {
        // Assign the current year to the data property once the component is mounted
        this.currentYear = new Date().getFullYear();
        window.env = {
            APP_NAME: '{{ env("APP_NAME") }}',
            // Add other environment variables as needed
        };
    },
};
</script>

<template>
    <footer class="border-t border-gray-500 bg-gray-50 dark:bg-oynx_alt">
        <div class="mx-auto container px-4 py-16 sm:px-6 lg:px-8">
            <div class="lg:flex lg:items-start lg:gap-8">
                <div
                    class="mt-8 grid grid-cols-2 gap-8 lg:mt-0 lg:grid-cols-3 lg:gap-y-16 w-full"
                >
                    <div class="col-span-2 sm:col-span-1">
                        <p class="font-bold text-gray-600">Resources</p>

                        <ul class="mt-6 space-y-4 text-sm">
                            <li>
                                <a
                                    href="#"
                                    class="text-oynx dark:text-snow transition hover:opacity-75"
                                    >Features 
                                </a>
                            </li>

                            <li>
                                <a
                                    href="#"
                                    class="text-oynx dark:text-snow transition hover:opacity-75"
                                >
                                   Career
                                </a>
                            </li>

                            <li>
                                <a
                                    href="#"
                                    class="text-oynx dark:text-snow transition hover:opacity-75"
                                >
                                    FAQ
                                </a>
                            </li>

                            <li>
                                <a
                                    :href="route('resources.return')"
                                    class="text-oynx dark:text-snow transition hover:opacity-75"
                                >
                                    Returns Policy
                                </a>
                            </li>

                            <li>
                                <a
                                    href="#"
                                    class="text-oynx dark:text-snow transition hover:opacity-75"
                                >
                                    Refund Policy
                                </a>
                            </li>
                           
                        </ul>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <p class="font-bold text-gray-600">Support</p>

                        <ul class="mt-6 space-y-4 text-sm">
                            <li>
                                <a target="_blank"
                                    href="https://www.instagram.com/mymealni/"
                                    class="text-oynx dark:text-snow transition hover:opacity-75"
                                >
                                    Instagram
                                </a>
                            </li>
                            <li>
                                <a target="_blank"
                                    href="https://www.facebook.com/profile.php?id=61568191215998"
                                    class="text-oynx dark:text-snow transition hover:opacity-75"
                                >
                                    Facebook
                                </a>
                            </li>

                            <li>
                                <a
                                    href="tel:+17052793660"
                                    class="text-oynx dark:text-snow transition hover:opacity-75"
                                >
                                  Phone Number
                                </a>
                            </li>

                            <li>
                                <a
                                    href="mailto:messages@mymealni.com"
                                    class="text-oynx dark:text-snow transition hover:opacity-75">
                                    Email Address </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-span-2 sm:col-span-1">
                        <p class="font-bold text-gray-600">Cook</p>

                        <ul class="mt-6 space-y-4 text-sm">
                            <li>
                                <a
                                    href="#"
                                    class="text-oynx dark:text-snow transition hover:opacity-75"
                                >
                                    Accessibility
                                </a>
                            </li>

                            <li>
                                <a
                                    href="#"
                                    class="text-oynx dark:text-snow transition hover:opacity-75"
                                >
                                   Cook Resources
                                </a>
                            </li>
                        </ul>
                    </div>

                    <ul
                        class="col-span-2 flex justify-start gap-6 lg:col-span-5 lg:justify-end"
                    >
                        <li>
                            <a
                                href="#"
                                rel="noreferrer"
                                class="navbar-link p-2"
                            >
                                <font-awesome-icon icon="globe" class="mr-2" />
                                <span class="text-sm font-bold">Eng</span>
                                <span class="sr-only">Language</span>
                            </a>
                        </li>
                        <li>
                            <a
                                href="#"
                                rel="noreferrer"
                                target="_blank"
                                class="navbar-link p-2"
                            >
                                <span class="sr-only">Facebook</span>

                                <svg
                                    class="h-6 w-6"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                rel="noreferrer"
                                target="_blank"
                                class="navbar-link p-2"
                            >
                                <span class="sr-only">Instagram</span>

                                <svg
                                    class="h-6 w-6"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                rel="noreferrer"
                                target="_blank"
                                class="navbar-link p-2"
                            >
                                <span class="sr-only">Twitter</span>

                                <svg
                                    class="h-6 w-6"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"
                                    />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-500 pt-8">
                <div class="sm:flex sm:justify-between">
                    <p class="text-xs text-gray-500">
                        &copy; {{ currentYear }}. {{ appName }} . All rights
                        reserved.
                    </p>

                    <ul
                        class="mt-8 flex flex-wrap justify-start gap-4 text-xs sm:mt-0 lg:justify-end"
                    >
                        <li>
                            <a
                                href="#"
                                class="text-gray-500 transition hover:opacity-75"
                            >
                                Terms & Conditions
                            </a>
                        </li>

                        <li>
                            <a
                                 target="_blank"
                                :href="route('policy.show')"
                                class="text-gray-500 transition hover:opacity-75"
                            >
                                Privacy Policy
                            </a>
                        </li>

                        <li>
                            <a
                                target="_blank"
                                :href="route('terms.show')"
                                class="text-gray-500 transition hover:opacity-75"
                            >
                                Cookies
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</template>

<style>
.Btn {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    background-color: transparent;
    position: relative;
    /* overflow: hidden; */
    border-radius: 7px;
    cursor: pointer;
    transition: all 0.3s;
}

.svgContainer {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: transparent;
    backdrop-filter: blur(0px);
    letter-spacing: 0.8px;
    border-radius: 10px;
    transition: all 0.3s;
    border: 1px solid rgba(156, 156, 156, 0.466);
}

.BG {
    position: absolute;
    content: "";
    width: 100%;
    height: 100%;
    background: #181818;
    z-index: -1;
    border-radius: 10px;
    pointer-events: none;
    transition: all 0.3s;
}

.Btn:hover .BG {
    transform: rotate(35deg);
    transform-origin: bottom;
}

.Btn:hover .svgContainer {
    background-color: rgba(156, 156, 156, 0.466);
    backdrop-filter: blur(4px);
}
</style>
