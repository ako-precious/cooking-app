<script setup>
import { Head, Link } from "@inertiajs/vue3";

import Footer from "@/Layouts/Footer.vue";

import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import HeaderVue from "./Header.vue";
import { route } from "ziggy-js";
import { useForm } from "@inertiajs/vue3";
import ErrorMessage from "@/Layout/Component/ErrorMessage.vue";
const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});
const register = () => form.post(route("register.store"));
</script>

<template>
    <Head title="Resources" />
    <div
        class="relative sm:flex sm:justify-center sm:items-center bg-center bg-snow dark:bg-oynx selection:bg-red-500 selection:text-white"
    >
        <div class="container relative mx-auto overflow-hidden">
            <HeaderVue> </HeaderVue>

            <div
                class="m-auto flex flex-col justify-center h-full p-6 lg:pb-10 w-full"
            >
                <div class="lg:w-full">
                    <div class="flex flex-col w-full">
                        <div
                            class="flex flex-col md:flex-row items-start justify-between md:items-center"
                        >
                            <div class="py-3">
                                <h1
                                    class="font-semibold text-xl lg:text-2xl text-oynx dark:text-snow"
                                >
                                    <nav class="flex" aria-label="Breadcrumb">
                                        <ol
                                            class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse"
                                        >
                                            <li
                                                class="inline-flex items-center"
                                            >
                                                <a
                                                    href="#"
                                                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white"
                                                >
                                                    <svg
                                                        class="w-3 h-3 me-2.5"
                                                        aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor"
                                                        viewBox="0 0 20 20"
                                                    >
                                                        <path
                                                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"
                                                        />
                                                    </svg>
                                                    Resources
                                                </a>
                                            </li>
                                            <li>
                                                <div class="flex items-center">
                                                    <svg
                                                        class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1"
                                                        aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 6 10"
                                                    >
                                                        <path
                                                            stroke="currentColor"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="m1 9 4-4-4-4"
                                                        />
                                                    </svg>
                                                    <a
                                                        href="#"
                                                        class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white"
                                                        >General</a
                                                    >
                                                </div>
                                            </li>
                                            <li aria-current="page">
                                                <div class="flex items-center">
                                                    <svg
                                                        class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1"
                                                        aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 6 10"
                                                    >
                                                        <path
                                                            stroke="currentColor"
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="m1 9 4-4-4-4"
                                                        />
                                                    </svg>
                                                    <span
                                                        class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400"
                                                        >Return Policy
                                                    </span>
                                                </div>
                                            </li>
                                        </ol>
                                    </nav>
                                </h1>
                            </div>
                            <div
                                class="flex flex-wrap md:flex-row items-start justify-between md:items-center"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="container p-4 lg:p-8 mx-auto relative grid grid-cols-1 lg:grid-cols-3 min-h-screen selection:bg-red-500 selection:text-white bg-snow dark:bg-oynx"
            >
                <div class="col-span-2"><div class="lg:w-full">
                        <div class="flex flex-col w-full">
                            <div
                                class="flex justify-center item-center lg:gap-10 lg:px-10"
                            >
                                <div class="w-full max-w-full py-2">
                                    <form  @submit.prevent="resources.store" 
                                        class="relative flex min-w-0 break-words w-full py-4 shadow-reverse group rounded-2xl bg-clip-border"
                                    >
                                        <div
                                            class="m-auto flex lg:flex-col justify-center flex-wrap w-full p-4 mb-0 list-none rounded-xl"
                                        >
                                            <div class="py-5 w-full px-1">
                                                <InputLabel
                                                    for="name"
                                                    value="Title"
                                                />
                                                <TextInput
                                                    id="name"
                                                  
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    required
                                                    autocomplete=""
                                                />
                                              
                                            </div>
                                            <div class="py-5 w-full px-1">
                                                <InputLabel
                                                    for="name"
                                                    value="Slug"
                                                />
                                                <TextInput
                                                    id="name"
                                                  
                                                    type="text"
                                                    class="mt-1 block w-full"
                                                    required
                                                    autocomplete="name"
                                                />
                                              
                                            </div>
                                            <div class="flex">
                                                <div class="py-5 w-full px-1">
                                                    <InputLabel
                                                        for="name"
                                                        value="Category"
                                                    />
                                                    <TextInput
                                                        id="name"
                                                      
                                                        type="text"
                                                        class="mt-1 block w-full"
                                                        required
                                                        autocomplete="name"
                                                    />
                                                  
                                                </div>
                                                <div class="py-5 w-full px-1">
                                                    <InputLabel
                                                        for="name"
                                                        value="Reading Time"
                                                    />
                                                    <TextInput
                                                        id="name"
                                                      
                                                        type="text"
                                                        class="mt-1 block w-full"
                                                        required
                                                        autocomplete="name"
                                                    />
                                                  
                                                </div>  

                                            </div>
                                            <div class="flex">
                                                <div class="py-5 w-full px-1">
                                                    <InputLabel
                                                        for="name"
                                                        value="Category"
                                                    />
                                                    <TextInput
                                                        id="name"
                                                      
                                                        type="text"
                                                        class="mt-1 block w-full"
                                                        required
                                                        autocomplete="name"
                                                    />
                                                  
                                                </div>
                                                <div class="py-5 w-full px-1">
                                                    <InputLabel
                                                        for="name"
                                                        value="Picture"
                                                    />
                                                    <TextInput
                                                        id="name"
                                                      
                                                        type="file"
                                                        class="mt-1 py-2 block w-full"
                                                        required
                                                        autocomplete="name"
                                                    />
                                                  
                                                </div>  

                                            </div>
                                            <div class="py-5 px-1">
                                                <InputLabel
                                                    for="name"
                                                    value="Content"
                                                />

                                                <textarea @input="checkLength"
                                                    autocomplete="other_info"
                                                    id="other_info"
                                                   
                                                    class="mt-1 block w-full disable-scrollbars border-oynx bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md text-oynx dark:text-snow"
                                                    rows="5"
                                                    cols="50"
                                                ></textarea>

                                                
                                            </div>
                                            <div>

                                                <button class="btn-17  " submit>
                                                  <span class="text-container">
                                                    <span class="text  bg-transparent ">Button</span>
                                                  </span>
                                                </button>
                                            </div>

                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- {{ $page.props.auth.user }} -->

        </div>
    </div>
    <Footer></Footer>
</template>


<style scoped>
/* From Uiverse.io by doniaskima */ 
.btn-17,
.btn-17 *,
.btn-17 :after,
.btn-17 :before,
.btn-17:after,
.btn-17:before {
  border: 0 solid;
  box-sizing: border-box;
}

.btn-17 {
  -webkit-tap-highlight-color: transparent;
  -webkit-appearance: button;
  background-color: transparent;
  background-image: none;
  color: #1B998B;
  cursor: pointer;

  font-size: 100%;
  font-weight: 900;
  line-height: 1.5;
  margin: 0;
  padding: 0;
  text-transform: uppercase;
}

.btn-17:disabled {
  cursor: default;
}

.btn-17:-moz-focusring {
  outline: auto;
}

.btn-17 svg {
  display: block;
  vertical-align: middle;
}

.btn-17 [hidden] {
  display: none;
}

.btn-17 {
  border-radius: 99rem;
  border-width: 2px;
  padding: 0.8rem 3rem;
  z-index: 0;
}

.btn-17,
.btn-17 .text-container {
  overflow: hidden;
  position: relative;
}

.btn-17 .text-container {
  display: block;
  mix-blend-mode: difference;
}

.btn-17 .text {
  display: block;
  position: relative;
}

.btn-17:hover .text {
  -webkit-animation: move-up-alternate 0.3s forwards;
  animation: move-up-alternate 0.3s forwards;
  color: #fff;

}

@-webkit-keyframes move-up-alternate {
  0% {
    transform: translateY(0);
  }

  50% {
    transform: translateY(80%);
  }

  51% {
    transform: translateY(-80%);
  }

  to {
    transform: translateY(0);
  }
}

@keyframes move-up-alternate {
  0% {
    transform: translateY(0);
  }

  50% {
    transform: translateY(80%);
  }

  51% {
    transform: translateY(-80%);
  }

  to {
    transform: translateY(0);
  }
}

.btn-17:after,
.btn-17:before {
  --skew: 0.2;
  background: #1B998B;
  content: "";
  display: block;
  height: 102%;
  left: calc(-50% - 50% * var(--skew));
  pointer-events: none;
  position: absolute;
  top: -104%;
  transform: skew(calc(150deg * var(--skew))) translateY(var(--progress, 0));
  transition: transform 0.2s ease;
  width: 100%;
}

.btn-17:after {
  --progress: 0%;
  left: calc(50% + 50% * var(--skew));
  top: 102%;
  z-index: -1;
}

.btn-17:hover:before {
  --progress: 100%;
}

.btn-17:hover:after {
  --progress: -102%;
}
</style>