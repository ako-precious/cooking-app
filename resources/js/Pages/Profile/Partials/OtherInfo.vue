<script setup></script>

<template>
    <div
        class="p-10 lg:w-3/5 m-auto shadow-reverse bg-snow dark:bg-oynx rounded-md relative"
    >
        <div style="display: unset">
            <div class="sticky top-0 w-full bg-snow dark:bg-oynx">
                <button
                    @click="$emit('close')"
                    type="button"
                    title="Close Button"
                    class="float-right top-3 right-5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-12 h-12 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal"
                >
                    <font-awesome-icon
                        icon="fa-solid fa-close"
                        class="text-lighred text-2xl"
                    />
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <div class="mb-6">
                <label
                    for="password"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                    >Can you share a brief background about yourself, including
                    your cooking experience, and what's your favorite dish to
                    prepare?</label
                >
                <textarea
                    id="message"
                    rows="6"
                    @input="checkLength"
                    v-model="question1"
                    class="bg-transparent border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-2 focus:ring-fuchsia-50 focus:border-fuchsia-300 block w-full p-2.5 dark:text-white"
                    placeholder="Growing up in a family of foodies, I was always surrounded by delicious meals and learned the basics of cooking from my parents. Over the years, I've honed my skills through trial and error, cooking for family gatherings, and exploring different cuisines. 
With over 5 years of regular cooking experience, I've developed a particular fondness for baking, roasting, and slow-cooking. 
My favorite dish to prepare is her famous lasagna recipe, which I've made my own over time. "
                ></textarea>
                <p
                    class="my-3"
                    :class="
                        maxLength ? 'text-lighred' : 'text-oynx dark:text-snow'
                    "
                >
                    {{ inputLength }}/600
                </p>
            </div>
            <div class="mb-6">
                <label
                    for="email"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                    >What makes your cooking unique, and what can customers
                    expect from your dishes?
                </label>
                <textarea
                    id="message"
                    rows="5"
                    @input="checkLength2"
                    v-model="question2"
                    class="bg-transparent border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-2 focus:ring-fuchsia-50 focus:border-fuchsia-300 block w-full p-2.5 dark:text-white"
                    placeholder="My cooking is unique because I blend traditional techniques with modern flavors and ingredients, creating dishes that are both familiar and innovative. I'm passionate about using locally sourced, seasonal ingredients to craft menus that showcase the best of each region.
My goal is to take customers on a culinary journey, exploring new flavors and ideas while feeling comforted by the warmth and love that goes into each dish."
                ></textarea>
                <p
                    class="my-3"
                    :class="
                        maxLength2 ? 'text-lighred' : 'text-oynx dark:text-snow'
                    "
                >
                    {{ inputLength2 }}/600
                </p>
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
                    @input="checkLength3"
                    v-model="question3"
                    class="bg-transparent border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-2 focus:ring-fuchsia-50 focus:border-fuchsia-300 block w-full p-2.5 dark:text-white"
                    placeholder="I ensure food safety and hygiene by following proper hand washing, storage, and cooking protocols, separating raw and ready-to-eat foods, and regularly cleaning and sanitizing my kitchen. I prioritize a clean and organized environment to serve safe and healthy meals."
                ></textarea>
                <p
                    class="my-3"
                    :class="
                        maxLength3 ? 'text-lighred' : 'text-oynx dark:text-snow'
                    "
                >
                    {{ inputLength3 }}/600
                </p>
            </div>

            <button
                @click="saveData()"
                class="text-white bg-gradient-to-br from-oynx to-persian font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 text-center inline-flex items-center shadow-md shadow-gray-300 dark:shadow-gray-900 hover:scale-[1.02] transition-transform"
            >
                Submit
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    props: {    
            cook: Object
        },
    data() {
        return {
            maxLength: false,
            maxLength2: false,
            maxLength3: false,
            cook:this.cook,
            question1: this.cook.question1 || '',
            question2: this.cook.question2 || '',
            question3: this.cook.question3 || '',
        };
    },
    computed: {
        inputLength() {
            return this.question1.length; // Calculate the length of the input text
        },
        inputLength2() {
            return this.question2.length; // Calculate the length of the input text
        },
        inputLength3() {
            return this.question3.length; // Calculate the length of the input text
        },
    },

    methods: {
        saveData() {
            // Log the meal data to console
            // Send an HTTP request to your backend API to save the data
            if (this.maxLength || this.mexLength2 || this.mexLength3) {
            } else {
                const  questions = {
                question1 : this.question1,
                question2 : this.question2,
                question3 : this.question3,
                }
                console.log(questions );
                axios
                    .put("/cook/menu/" + this.cook.id, questions)
                    .then((response) => {
                        console.log(response.data);
                        this.$inertia.visit(`/user-profile/${this.cook.user_id}`);
                    })
                    .catch((error) => {
                        // Handle error
                        // console.error("Error saving data:", error);
                    });
            }
        },
        checkLength(event) {
            if (this.inputLength >= 600) {
                // If input length exceeds the maximum length, prevent further input
                this.maxLength = true;
                event.preventDefault();
                // Optionally, you can provide feedback to the user that the maximum length has been reached
                console.log(
                    this.maxLength +
                        "Maximum length reached. You cannot enter more characters."
                );
            } else {
                this.maxLength = false;
            }
        },
        checkLength2(event) {
            if (this.inputLength2 >= 600) {
                // If input length exceeds the maximum length, prevent further input
                this.maxLength2 = true;
                event.preventDefault();
                // Optionally, you can provide feedback to the user that the maximum length has been reached
                console.log(
                    this.maxLength2 +
                        "Maximum length reached. You cannot enter more characters."
                );
            } else {
                this.maxLength2 = false;
            }
        },
        checkLength3(event) {
            if (this.inputLength3 >= 600) {
                // If input length exceeds the maximum length, prevent further input
                this.maxLength3 = true;
                event.preventDefault();
                // Optionally, you can provide feedback to the user that the maximum length has been reached
                console.log(
                    "Maximum length reached. You cannot enter more characters."
                );
            } else {
                this.maxLength3 = false;
            }
        },
    },
};
</script>
