<template>
    <div
                class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto"
            >
                <!-- <div class="flex items-center md:ml-auto md:pr-4">
                    <div
                        class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease"
                    >
                        <span
                            class="text-sm ease leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all"
                        >
                            <i class="fas fa-search"></i>
                        </span>
                        <input
                            type="text"
                            class="pl-9 text-sm focus:shadow-primary-outline ease w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 dark:bg-slate-850 dark:text-white bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-blue-500 focus:outline-none focus:transition-shadow"
                            placeholder="Type here..."
                        />
                    </div>
                </div> -->
                <ul
                    class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full"
                >
                   

                    <li class="flex items-center pl-4 xl:hidden"  >
                        <a
                            href="javascript:;"
                            class="block p-0 text-sm text-white transition-all ease-nav-brand"
                            sidenav-trigger
                        >
                        <slot>Default</slot>
                            
                        </a>
                    </li>
                  

                    <!-- notifications -->
                </ul>
            </div>
</template>
<script setup>

</script>
<script></script>
