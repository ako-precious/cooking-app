<template>    
    <div
    id="defaultModal"
    tabindex="-1"
    aria-hidden="true"
    class=" overflow-y-auto overflow-x-hidden flex justify-center items-center fixed top-0 right-0 left-0 w-full md:inset-0 h-modal md:h-full z-990"
    >
    <div class="relative p-4  w-full m-auto max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-snow rounded-lg shadow dark:bg-oynx">
            <!-- Modal header -->
            <div
                class="flex justify-between items-start p-5 rounded-t border-b dark:border-oynx"
            >
                <h3
                    class="text-xl font-semibold text-oynx lg:text-2xl dark:text-snoww"
                >
                    Terms of Service
                </h3>
                <button
                    type="button"
                    class="text-oynx bg-transparent hover:bg-snow hover:text-oynx rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-oynx dark:hover:text-snoww"
                    data-modal-toggle="defaultModal"
                >
                    <svg
                        class="w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="h-60 overflow-y-auto p-5 space-y-6">
                <p
                    class="text-sm leading-relaxed text-oynx dark:text-oynx"
                >
                    Ounjemi is a student-run cooking platform that connects
                    home cooks with customers. Please be aware that meals
                    prepared by our student cooks are typically made in
                    their personal homes, which may not have been inspected
                    by public health officials. However, we ensure that all
                    our cooks hold a valid Food Handling Certificate,
                    demonstrating their understanding of proper food
                    handling and safety practices.
                </p>
                <p
                    class="text-sm leading-relaxed text-oynx dark:text-oynx"
                >
                    While we take steps to ensure the quality and safety of
                    our meals, we want to transparently disclose this
                    information to our customers. Additionally, we encourage
                    customers to rate their meals after each order, helping
                    us maintain high standards and accountability within our
                    community.
                </p>
                <p
                    class="text-sm leading-relaxed text-oynx dark:text-oynx"
                >
                    Please note that our platform is in its early stages,
                    and many of our student cooks share apartments, making
                    it challenging to meet traditional commercial kitchen
                    inspection standards. We appreciate your understanding
                    and support as we grow and evolve.
                </p>
                <p
                    class="text-sm leading-relaxed text-oynx dark:text-oynx"
                >
                    Please note that our platform is in its early stages,
                    and many of our student cooks share apartments, making
                    it challenging to meet traditional commercial kitchen
                    inspection standards. We appreciate your understanding
                    and support as we grow and evolve.
                </p>
                <p
                    class="text-sm leading-relaxed text-oynx dark:text-oynx"
                >
                We encourage you to read our disclaimer carefully before placing your order with Ounjemi. By proceeding, you confirm your understanding and acceptance of the terms."
                </p>
            </div>
            <!-- Modal footer -->
            <div
                class="flex items-center p-5 space-x-2 rounded-b border-t border-snow dark:border-oynx"
            >
                <button
                    data-modal-toggle="defaultModal"
                    type="button"
                    class="text-snoww bg-gradient-to-br from-persian to-voilet-500 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 text-center inline-flex items-center shadow-md shadow-oynx hover:scale-[1.02] transition-transform"
                >
                    I accept
                </button>
                <button
                    data-modal-toggle="defaultModal"
                    type="button"
                    class="text-oynx bg-snoww hover:bg-oynx rounded-lg border border-snow text-sm font-medium px-5 py-2.5 hover:text-oynx focus:z-10 dark:bg-oynx dark:text-oynx dark:border-oynx dark:hover:text-snoww dark:hover:bg-oynx dark:focus:ring-oynx"
                >
                    Decline
                </button>
            </div>
        </div>
    </div>
    </div>
</template>
