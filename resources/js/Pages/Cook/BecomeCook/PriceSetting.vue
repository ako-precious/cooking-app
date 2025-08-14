<script setup>
import { Head, Link } from "@inertiajs/vue3";
import LightModePortion from "@/Components/Icons/LightModePortion.vue";
import DarkModePortion from "@/Components/Icons/DarkModePortion.vue";
import BecomeCook from "./BecomeCook.vue";
import TextInput from "@/Components/TextInput.vue";
</script>

<template>
    <BecomeCook>
        <template #info>
            <div
                class="container relative mx-auto overflow-hidden pb-10 lg:p-0 w-screen"
            >
                <div
                    class="m-auto flex flex-col lg:flex-row items-center h-full lg:p-8"
                >
                    <div class="lg:w-2/5 py-5 lg:px-5">
                        <h1
                            class="font-semibold text-3xl lg:text-4xl tracking-wide text-oynx dark:text-snow"
                        >
                            Set the size and the price for the meal
                        </h1>
                        <h1 class="pt-5 text-lg text-oynx dark:text-snow">
                            Craft a price that reflects the size and the unique
                            joy of enjoying your culinary creation
                        </h1>
                    </div>
                    <div class="w-full lg:w-3/5">
                        <div class="flex flex-col w-full">
                            <div
                                v-for="(price_set, index) in prices"
                                :key="index"
                                class="flex lg:p-5 items-center"
                            >
                                <div
                                    class="flex-grow flex items-center justify-between space-x-2"
                                >
                                    <div
                                        class="flex items-center space-x-2 w-3/4"
                                    >
                                        <LightModePortion
                                            class="dark:hidden block h-8 mr-2"
                                        />
                                        <DarkModePortion
                                            class="hidden dark:block h-8 mr-2"
                                        />
                                        <input
    type="text"
    placeholder="Enter number"
    v-model="prices[index].size"
    :readonly="['small','medium','large','xl'].includes(prices[index].unit)"
    class="border-2 rounded-lg bg-transparent border-gray-300 p-2 focus:ring-persian focus:border-persian text-oynx dark:text-snow w-20 text-sm"
                                    
  />
                                        <select  v-model="prices[index].unit"
                                            class="border-2 rounded-lg bg-transparent border-gray-300 w-2/4 p-2 focus:ring-persian focus:border-persian text-oynx dark:text-snow text-sm"
                                            name="units"
                                            id="units"
                                        >
                                            
                                            <option class="border-2 rounded-lg bg-snow dark:bg-oynx p-2 " value="" disabled>Select a unit:</option>
                                            <option
                                                class="border-2 rounded-lg bg-snow dark:bg-oynx p-2"
                                                value="ounce"
                                            >
                                                Ounce (oz)
                                            </option>
                                            <option
                                                class="border-2 rounded-lg bg-snow dark:bg-oynx p-2"
                                                value="pound"
                                            >
                                                Pound (lb)
                                            </option>
                                            <option
                                                class="border-2 rounded-lg bg-snow dark:bg-oynx p-2"
                                                value="milliliter"
                                            >
                                                Milliliter (mL)
                                            </option>
                                            <option
                                                class="border-2 rounded-lg bg-snow dark:bg-oynx p-2"
                                                value="liter"
                                            >
                                                Liter (L)
                                            </option>
                                            <option
                                                class="border-2 rounded-lg bg-snow dark:bg-oynx p-2"
                                                value="gram"
                                            >
                                                Gram (g)
                                            </option>
                                            <option
                                                class="border-2 rounded-lg bg-snow dark:bg-oynx p-2"
                                                value="kilogram"
                                            >
                                                Kilogram (kg)
                                            </option>
                                            <option
                                                class="border-2 rounded-lg bg-snow dark:bg-oynx p-2"
                                                value="piece"
                                            >
                                                Piece (pc)
                                            </option>
                                            <option
                                                class="border-2 rounded-lg bg-snow dark:bg-oynx p-2"
                                                value="small"
                                            >
                                                Small (sm)
                                            </option>
                                            <option
                                                class="border-2 rounded-lg bg-snow dark:bg-oynx p-2"
                                                value="medium"
                                            >
                                                Medium (md)
                                            </option>
                                            <option
                                                class="border-2 rounded-lg bg-snow dark:bg-oynx p-2"
                                                value="large"
                                            >
                                                Large (lg)
                                            </option>
                                            <option
                                                class="border-2 rounded-lg bg-snow dark:bg-oynx p-2"
                                                value="xl"
                                            >
                                                Extra Large (xl)
                                            </option>
                                        </select>
                                    </div>
                                    <div class="flex items-center px-2 w-1/4">
                                        <font-awesome-icon
                                            icon="dollar-sign"
                                            class="text-oynx dark:text-snow h-8 mr-2"
                                        />
                                        <input
                                            type="number"
                                            placeholder="Price"min="0"
                                            step="0.01"
                                            class="border-2 rounded-lg bg-transparent border-gray-300 p-2 focus:ring-persian focus:border-persian text-oynx dark:text-snow w-20 text-sm"
                                           v-model.number="prices[index].price"
                                        />
                                    </div>
                                    <div class="flex items-center px-2 w-8">
                                        <button
                                            type="button"
                                            v-show="prices.length > 1"
                                            @click="removePriceField(index)"
                                            class="text-red-500 hover:text-red-700 flex items-center space-x-2 transition-colors duration-200"
                                        >
                                            <font-awesome-icon
                                                icon="fa-solid fa-trash h-8 "
                                            />
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-center p-5">
                                <button
                                    type="button"
                                    @click="addPriceField"
                                    class="text-persian hover:text-persian-dark font-semibold transition-colors duration-200 capitalize"
                                >
                                    + Add size and price
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template #progressbar>
            <div class="h-1 w-full bg-neutral-400 dark:bg-neutral-600">
                <div
                    class="h-1 bg-persian transition-all duration-250 delay-75"
                    style="width: 90%"
                ></div>
            </div>
        </template>
        <template #backbtn>
            <div class="float-left ml-8 h-full flex items-center">
                <Link
                    :href="`/become-a-cook/${Meal.id}/ordering-preference`"
                    class="font-semibold"
                >
                    <button class="relative group">
                        <span class="hover-underline-animation"> Back </span>
                    </button>
                </Link>
            </div>
        </template>
        <template #mainbtn>
            <button @click="saveData" class="btn2span group">
                <span class="next-span">Next Step</span>
                <span class="with-span">We're with you</span>
            </button>
        </template>
    </BecomeCook>
</template>

<script>
import axios from "axios";

export default {
    props: {
        Meal: Object,
    },
    data() {
        return {
            prices: [
                { size: "", unit: "Select a Unit", price: null },
            ],
        };
    },
    watch: {
  prices: {
    deep: true,
    handler(newPrices) {
      newPrices.forEach(price => {
        if (['small','medium','large','xl'].includes(price.unit)) {
          price.size = price.unit; // automatically set size
        }
      });
    }
  }
},
    created() {
        if (this.Meal && this.Meal.prices) {
            if (Array.isArray(this.Meal.prices) && this.Meal.prices.length > 0) {
                this.prices = this.Meal.prices.map(p => ({
                    size: p.size || "",
                    unit: p.unit || "Select a Unit",
                    price: p.price ?? null
                }));
            }
        }
    },

    methods: {
        addPriceField() {
            this.prices.push({ size: "", unit: "Select a Unit", price: null });
        },
        removePriceField(index) {
            this.prices.splice(index, 1);
        },
        saveData() {

         console.log(this.prices);
         

            axios
                .put(`/meal/price/${this.Meal.id}`, { prices: this.prices })
                .then((response) => {
                    const MealId = response.data.meal.id;
                    this.$inertia.visit(`/become-a-cook/${MealId}/final-overview`);
                })
                .catch((error) => {
                    console.error("Error saving data:", error);
                });
        },
    },
};
</script>

<!-- <template>
    <BecomeCook>
        <template #info>
            <div
                class="container relative mx-auto overflow-hidden pb-10 lg:p-0 w-screen"
            >
                <div
                    class="m-auto flex flex-col lg:flex-row items-center h-full lg:p-8"
                >
                    <div class="lg:w-1/2 py-5 lg:px-5">
                        <h1
                            class="font-semibold text-3xl lg:text-4xl tracking-wide text-oynx dark:text-snow"
                        >
                            Set the price for the meal
                        </h1>
                        <h1 class="pt-5 text-lg text-oynx dark:text-snow">
                            Craft a price that reflects the unique joy of enjoying your culinary creation
                        </h1>
                    </div>
                    <div class="w-full lg:w-1/2">
                        <div class="flex flex-col w-full">
                            <div class="flex lg:p-5">
                                <div
                                    class="w-full lg:w-2/3 p-3 lg:p-10 lg:ml-8"
                                >
                                <p class="font-semibold text-4xl lg:text-5xl tracking-wide text-oynx dark:text-snow flex items-center"><font-awesome-icon icon="dollar-sign" /> <input type="number" class=" border-2 bg-transparent border-none w-2/3 focus:ring-0 text-4xl lg:text-5xl" v-model="count" name="" id=""> {{  }}</p>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template #progressbar>
            <div class="h-1 w-full bg-neutral-400 dark:bg-neutral-600">
                <div
                    class="h-1 bg-persian transition-all duration-250 delay-75"
                    style="width: 90%"
                ></div>
            </div>
        </template>
        <template #backbtn>
            <div class="float-left ml-8 h-full flex items-center">
                <Link
                    :href="`/become-a-cook/${Meal.id}/ordering-preference`"
                    class="font-semibold"
                >
                <button class="relative group">
                        <span
                            class="hover-underline-animation"
                        >
                            Back
                        </span>
                    </button>
                </Link>
            </div>
        </template>
        <template #mainbtn>
           
                    <button @click="saveData" class="btn2span group">
                    <span class="next-span">Next Step</span>
                    <span class="with-span">We're with you</span>
                </button>
            </template>
    </BecomeCook>
</template>

<script>
import axios from "axios";
export default {
    props: {
        Meal: Object,
        
    },
    data() {
        return { 
            count: this.Meal.price,
        };
    },
    methods: {
        saveData() {
            // Send an HTTP request to your backend API to save the data
            const price = this.count;
            
                axios
                    .put("/meal/price/" + this.Meal.id, { price })
                    .then((response) => {
                        // Handle successful response
                        // console.log(response.data.meal);
                        const MealId = response.data.meal.id;
                        this.$inertia.visit(
                            `/become-a-cook/${MealId}/final-overview`
                        );
                    })
                    .catch((error) => {
                        // Handle error
                        // console.error("Error saving data:", error);
                    });
            
        },
    },
};
</script> -->

<style scoped>
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Remove spinners from Firefox */
input[type="number"] {
    -moz-appearance: textfield;
}
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}

@keyframes fade-in {
    from {
        opacity: 0;
        bottom: -10rem;
    }
    to {
        opacity: 1;
        bottom: 0;
    }
}

.animate-fade-in {
    animation: fade-in 0.7s ease-in;
}
</style>
