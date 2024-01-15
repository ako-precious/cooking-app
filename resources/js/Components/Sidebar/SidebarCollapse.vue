<template>
    <hr
        class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
    />
    <div
        class="items-center block w-full h-auto grow basis-full"
        id="sidenav-collapse-main"
    >
        <ul class="flex flex-col pl-0 mb-0 list-none">
            <slot>Default</slot>

            <!-- <li class="mt-0.5 w-full">
                    <a
                        collapse_trigger="primary"
                        href="javascript:;"
                        class="ease-in-out text-sm leading-default py-2.7 active after:ease-in-out after:font-awesome-5-free my-0 mx-2 flex items-center whitespace-nowrap px-4 font-medium text-slate-500 shadow-none transition-colors after:ml-auto after:inline-block after:font-bold after:text-slate-800/50 after:antialiased after:transition-all after:duration-200 dark:text-white dark:opacity-80 dark:after:text-white/50 dark:after:text-white after:content-['\f107']"
                        aria-controls="authExamples"
                        role="button"
                        aria-expanded="false"
                    >
                        <div
                            class="stroke-none flex h-8 w-8 items-center justify-center rounded-lg bg-center fill-current p-2.5 text-center text-black"
                        >
                            <i
                                class="text-sm leading-normal text-red-600 ni ni-single-copy-04"
                            ></i>
                        </div>
                        <span
                            class="ml-1 duration-300 pointer-events-none ease opacity-100"
                            >Authentication</span
                        >
                    </a>
                                    <div
                        class="h-auto overflow-hidden transition-all duration-200 ease-in-out max-h-0"
                        id="authExamples"
                    >
                        <ul
                            class="flex flex-wrap mb-0 list-none transition-all duration-200 ease-in-out pl-4 ml-6"
                        >
                            <li class="w-full">
                                <a
                                    collapse_trigger="secondary"
                                    class="after:ease-in-out after:font-awesome-5-free ease-in-out py-2.7 pl-4 leading-default text-sm relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors after:ml-auto after:inline-block after:font-bold after:text-slate-800/50 after:antialiased after:transition-all after:duration-200 after:content-['\f107'] dark:text-white dark:opacity-60 dark:after:text-white/50 dark:after:text-white before:content-[''] ml-5.4"
                                    aria-expanded="false"
                                    href="javascript:;"
                                >
                                    <span
                                        class="w-0 text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                    >
                                        S
                                    </span>
                                    <span
                                        class="transition-all duration-100 pointer-events-none ease opacity-100"
                                    >
                                        Sign In <b class="caret"></b
                                    ></span>
                                </a>
                                <div
                                    class="h-auto overflow-hidden transition-all duration-200 ease-in-out max-h-0"
                                    id="signinExample"
                                >
                                    <ul
                                        class="flex flex-col flex-wrap pl-0 mb-0 list-none transition-all duration-200 ease-in-out"
                                    >
                                        <li class="w-full">
                                            <a
                                                class="ease-in-out py-2.7 pl-4 text-3.2 relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors dark:text-white dark:opacity-60 before:content-[''] ml-5.4"
                                                href="../../pages/authentication/signin/basic.html"
                                            >
                                                <span
                                                    class="w-0 text-xs leading-tight text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                                >
                                                    B
                                                </span>
                                                <span
                                                    class="transition-all duration-100 pointer-events-none ease opacity-100"
                                                >
                                                    Basic
                                                </span>
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a
                                                class="ease-in-out py-2.7 pl-4 text-3.2 relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors dark:text-white dark:opacity-60 before:content-[''] ml-5.4"
                                                href="../../pages/authentication/signin/cover.html"
                                            >
                                                <span
                                                    class="w-0 text-xs leading-tight text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                                >
                                                    C
                                                </span>
                                                <span
                                                    class="transition-all duration-100 pointer-events-none ease opacity-100"
                                                >
                                                    Cover
                                                </span>
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a
                                                class="ease-in-out py-2.7 pl-4 text-3.2 relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors dark:text-white dark:opacity-60 before:content-[''] ml-5.4"
                                                href="../../pages/authentication/signin/illustration.html"
                                            >
                                                <span
                                                    class="w-0 text-xs leading-tight text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                                >
                                                    I
                                                </span>
                                                <span
                                                    class="transition-all duration-100 pointer-events-none ease opacity-100"
                                                >
                                                    Illustration
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="w-full">
                                <a
                                    collapse_trigger="secondary"
                                    class="after:ease-in-out after:font-awesome-5-free ease-in-out py-2.7 pl-4 leading-default text-sm relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors after:ml-auto after:inline-block after:font-bold after:text-slate-800/50 after:antialiased after:transition-all after:duration-200 after:content-['\f107'] dark:text-white dark:opacity-60 dark:after:text-white/50 dark:after:text-white before:content-[''] ml-5.4"
                                    aria-expanded="false"
                                    href="javascript:;"
                                >
                                    <span
                                        class="w-0 text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                    >
                                        S
                                    </span>
                                    <span
                                        class="transition-all duration-100 pointer-events-none ease opacity-100"
                                    >
                                        Sign Up <b class="caret"></b
                                    ></span>
                                </a>
                                <div
                                    class="h-auto overflow-hidden transition-all duration-200 ease-in-out max-h-0"
                                    id="signupExample"
                                >
                                    <ul
                                        class="flex flex-col flex-wrap pl-0 mb-0 list-none transition-all duration-200 ease-in-out"
                                    >
                                        <li class="w-full">
                                            <a
                                                class="ease-in-out py-2.7 pl-4 text-3.2 relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors dark:text-white dark:opacity-60 before:content-[''] ml-5.4"
                                                href="../../pages/authentication/signup/basic.html"
                                            >
                                                <span
                                                    class="w-0 text-xs leading-tight text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                                >
                                                    B
                                                </span>
                                                <span
                                                    class="transition-all duration-100 pointer-events-none ease opacity-100"
                                                >
                                                    Basic
                                                </span>
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a
                                                class="ease-in-out py-2.7 pl-4 text-3.2 relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors dark:text-white dark:opacity-60 before:content-[''] ml-5.4"
                                                href="../../pages/authentication/signup/cover.html"
                                            >
                                                <span
                                                    class="w-0 text-xs leading-tight text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                                >
                                                    C
                                                </span>
                                                <span
                                                    class="transition-all duration-100 pointer-events-none ease opacity-100"
                                                >
                                                    Cover
                                                </span>
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a
                                                class="ease-in-out py-2.7 pl-4 text-3.2 relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors dark:text-white dark:opacity-60 before:content-[''] ml-5.4"
                                                href="../../pages/authentication/signup/illustration.html"
                                            >
                                                <span
                                                    class="w-0 text-xs leading-tight text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                                >
                                                    I
                                                </span>
                                                <span
                                                    class="transition-all duration-100 pointer-events-none ease opacity-100"
                                                >
                                                    Illustration
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="w-full">
                                <a
                                    collapse_trigger="secondary"
                                    class="after:ease-in-out after:font-awesome-5-free ease-in-out py-2.7 pl-4 leading-default text-sm relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors after:ml-auto after:inline-block after:font-bold after:text-slate-800/50 after:antialiased after:transition-all after:duration-200 after:content-['\f107'] dark:text-white dark:opacity-60 dark:after:text-white/50 dark:after:text-white before:content-[''] ml-5.4"
                                    aria-expanded="false"
                                    href="javascript:;"
                                >
                                    <span
                                        class="w-0 text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                    >
                                        R
                                    </span>
                                    <span
                                        class="transition-all duration-100 pointer-events-none ease opacity-100"
                                    >
                                        Reset Password <b class="caret"></b
                                    ></span>
                                </a>
                                <div
                                    class="h-auto overflow-hidden transition-all duration-200 ease-in-out max-h-0"
                                    id="resetExample"
                                >
                                    <ul
                                        class="flex flex-col flex-wrap pl-0 mb-0 list-none transition-all duration-200 ease-in-out"
                                    >
                                        <li class="w-full">
                                            <a
                                                class="ease-in-out py-2.7 pl-4 text-3.2 relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors dark:text-white dark:opacity-60 before:content-[''] ml-5.4"
                                                href="../../pages/authentication/reset/basic.html"
                                            >
                                                <span
                                                    class="w-0 text-xs leading-tight text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                                >
                                                    B
                                                </span>
                                                <span
                                                    class="transition-all duration-100 pointer-events-none ease opacity-100"
                                                >
                                                    Basic
                                                </span>
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a
                                                class="ease-in-out py-2.7 pl-4 text-3.2 relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors dark:text-white dark:opacity-60 before:content-[''] ml-5.4"
                                                href="../../pages/authentication/reset/cover.html"
                                            >
                                                <span
                                                    class="w-0 text-xs leading-tight text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                                >
                                                    C
                                                </span>
                                                <span
                                                    class="transition-all duration-100 pointer-events-none ease opacity-100"
                                                >
                                                    Cover
                                                </span>
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a
                                                class="ease-in-out py-2.7 pl-4 text-3.2 relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors dark:text-white dark:opacity-60 before:content-[''] ml-5.4"
                                                href="../../pages/authentication/reset/illustration.html"
                                            >
                                                <span
                                                    class="w-0 text-xs leading-tight text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                                >
                                                    I
                                                </span>
                                                <span
                                                    class="transition-all duration-100 pointer-events-none ease opacity-100"
                                                >
                                                    Illustration
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="w-full">
                                <a
                                    collapse_trigger="secondary"
                                    class="after:ease-in-out after:font-awesome-5-free ease-in-out py-2.7 pl-4 leading-default text-sm relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors after:ml-auto after:inline-block after:font-bold after:text-slate-800/50 after:antialiased after:transition-all after:duration-200 after:content-['\f107'] dark:text-white dark:opacity-60 dark:after:text-white/50 dark:after:text-white before:content-[''] ml-5.4"
                                    aria-expanded="false"
                                    href="javascript:;"
                                >
                                    <span
                                        class="w-0 text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                    >
                                        L
                                    </span>
                                    <span
                                        class="transition-all duration-100 pointer-events-none ease opacity-100"
                                    >
                                        Lock <b class="caret"></b
                                    ></span>
                                </a>
                                <div
                                    class="h-auto overflow-hidden transition-all duration-200 ease-in-out max-h-0"
                                    id="lockExample"
                                >
                                    <ul
                                        class="flex flex-col flex-wrap pl-0 mb-0 list-none transition-all duration-200 ease-in-out"
                                    >
                                        <li class="w-full">
                                            <a
                                                class="ease-in-out py-2.7 pl-4 text-3.2 relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors dark:text-white dark:opacity-60 before:content-[''] ml-5.4"
                                                href="../../pages/authentication/lock/basic.html"
                                            >
                                                <span
                                                    class="w-0 text-xs leading-tight text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                                >
                                                    B
                                                </span>
                                                <span
                                                    class="transition-all duration-100 pointer-events-none ease opacity-100"
                                                >
                                                    Basic
                                                </span>
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a
                                                class="ease-in-out py-2.7 pl-4 text-3.2 relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors dark:text-white dark:opacity-60 before:content-[''] ml-5.4"
                                                href="../../pages/authentication/lock/cover.html"
                                            >
                                                <span
                                                    class="w-0 text-xs leading-tight text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                                >
                                                    C
                                                </span>
                                                <span
                                                    class="transition-all duration-100 pointer-events-none ease opacity-100"
                                                >
                                                    Cover
                                                </span>
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a
                                                class="ease-in-out py-2.7 pl-4 text-3.2 relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors dark:text-white dark:opacity-60 before:content-[''] ml-5.4"
                                                href="../../pages/authentication/lock/illustration.html"
                                            >
                                                <span
                                                    class="w-0 text-xs leading-tight text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                                >
                                                    I
                                                </span>
                                                <span
                                                    class="transition-all duration-100 pointer-events-none ease opacity-100"
                                                >
                                                    Illustration
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="w-full">
                                <a
                                    collapse_trigger="secondary"
                                    class="after:ease-in-out after:font-awesome-5-free ease-in-out py-2.7 pl-4 leading-default text-sm relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors after:ml-auto after:inline-block after:font-bold after:text-slate-800/50 after:antialiased after:transition-all after:duration-200 after:content-['\f107'] dark:text-white dark:opacity-60 dark:after:text-white/50 dark:after:text-white before:content-[''] ml-5.4"
                                    aria-expanded="false"
                                    href="javascript:;"
                                >
                                    <span
                                        class="w-0 text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                    >
                                        2
                                    </span>
                                    <span
                                        class="transition-all duration-100 pointer-events-none ease opacity-100"
                                    >
                                        2-Step Verification <b class="caret"></b
                                    ></span>
                                </a>
                                <div
                                    class="h-auto overflow-hidden transition-all duration-200 ease-in-out max-h-0"
                                    id="StepExample"
                                >
                                    <ul
                                        class="flex flex-col flex-wrap pl-0 mb-0 list-none transition-all duration-200 ease-in-out"
                                    >
                                        <li class="w-full">
                                            <a
                                                class="ease-in-out py-2.7 pl-4 text-3.2 relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors dark:text-white dark:opacity-60 before:content-[''] ml-5.4"
                                                href="../../pages/authentication/verification/basic.html"
                                            >
                                                <span
                                                    class="w-0 text-xs leading-tight text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                                >
                                                    B
                                                </span>
                                                <span
                                                    class="transition-all duration-100 pointer-events-none ease opacity-100"
                                                >
                                                    Basic
                                                </span>
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a
                                                class="ease-in-out py-2.7 pl-4 text-3.2 relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors dark:text-white dark:opacity-60 before:content-[''] ml-5.4"
                                                href="../../pages/authentication/verification/cover.html"
                                            >
                                                <span
                                                    class="w-0 text-xs leading-tight text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                                >
                                                    C
                                                </span>
                                                <span
                                                    class="transition-all duration-100 pointer-events-none ease opacity-100"
                                                >
                                                    Cover
                                                </span>
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a
                                                class="ease-in-out py-2.7 pl-4 text-3.2 relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors dark:text-white dark:opacity-60 before:content-[''] ml-5.4"
                                                href="../../pages/authentication/verification/illustration.html"
                                            >
                                                <span
                                                    class="w-0 text-xs leading-tight text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                                >
                                                    I
                                                </span>
                                                <span
                                                    class="transition-all duration-100 pointer-events-none ease opacity-100"
                                                >
                                                    Illustration
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="w-full">
                                <a
                                    collapse_trigger="secondary"
                                    class="after:ease-in-out after:font-awesome-5-free ease-in-out py-2.7 pl-4 leading-default text-sm relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors after:ml-auto after:inline-block after:font-bold after:text-slate-800/50 after:antialiased after:transition-all after:duration-200 after:content-['\f107'] dark:text-white dark:opacity-60 dark:after:text-white/50 dark:after:text-white before:content-[''] ml-5.4"
                                    aria-expanded="false"
                                    href="javascript:;"
                                >
                                    <span
                                        class="w-0 text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                    >
                                        E
                                    </span>
                                    <span
                                        class="transition-all duration-100 pointer-events-none ease opacity-100"
                                    >
                                        Error <b class="caret"></b
                                    ></span>
                                </a>
                                <div
                                    class="h-auto overflow-hidden transition-all duration-200 ease-in-out max-h-0"
                                    id="errorExample"
                                >
                                    <ul
                                        class="flex flex-col flex-wrap pl-0 mb-0 list-none transition-all duration-200 ease-in-out"
                                    >
                                        <li class="w-full">
                                            <a
                                                class="ease-in-out py-2.7 pl-4 text-3.2 relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors dark:text-white dark:opacity-60 before:content-[''] ml-5.4"
                                                href="../../pages/authentication/error/404.html"
                                            >
                                                <span
                                                    class="w-0 text-xs leading-tight text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                                >
                                                    E
                                                </span>
                                                <span
                                                    class="transition-all duration-100 pointer-events-none ease opacity-100"
                                                >
                                                    Error 404
                                                </span>
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a
                                                class="ease-in-out py-2.7 pl-4 text-3.2 relative my-0 mr-2 flex items-center whitespace-nowrap bg-transparent pr-4 font-medium text-slate-800/50 shadow-none transition-colors dark:text-white dark:opacity-60 before:content-[''] ml-5.4"
                                                href="../../pages/authentication/error/500.html"
                                            >
                                                <span
                                                    class="w-0 text-xs leading-tight text-center transition-all duration-200 ease-in-out pointer-events-none opacity-0"
                                                >
                                                    E
                                                </span>
                                                <span
                                                    class="transition-all duration-100 pointer-events-none ease opacity-100"
                                                >
                                                    Error 500
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
            </li> -->
        </ul>
    </div>
</template>
<script setup></script>
<script></script>
