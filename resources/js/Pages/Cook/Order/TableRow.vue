<script setup>
import { Head, Link } from "@inertiajs/vue3";
defineProps(["meal"]);
</script>
<template>
    <td class="whitespace-nowrap px-6 py-3 font-semibold">
        <Link :href="``" class="flex items-center j">
            <p class="pl-4 lg:pl-8">
                {{ meal.meal.name }}
            </p>
        </Link>
    </td>
    <td class="whitespace-nowrap px-6 py-3">{{ meal.user.name }}</td>
    <td class="whitespace-nowrap px-6 py-3">{{ meal.meal_time }}</td>
    <td class="whitespace-nowrap px-6 py-3">
        {{ FormattedDate(meal.created_at) }}
    </td>

    <td class="whitespace-nowrap px-6 py-3 text-center">
        <div class="flex items-center">
            <p>
                {{ meal.status }}
            </p>
        </div>
    </td>
    <!-- <td v-else class="whitespace-nowrap px-6 py-3 ">
        <div class=" flex items-center ">
            <font-awesome-icon
                class="text-persian text-lg pr-1"
                icon="toggle-off"
            />
            Off
        </div>
    </td> -->
    <td class="whitespace-nowrap px-6 py-3">
        <button
            class="shadow-md rounded-full cursor-pointer w-[120px] h-[40px] text-oynx dark:text-snow font-semibold border-none flex justify-center items-center"
        >
            <span class="span-mother flex overflow-hidden">
                <span>Ch</span>
                <span>an</span>
                <span>ge S</span>
                <span>ta</span>
                <span>tu</span>
                <span>s</span>
            </span>
            <span class="span-mother2">
                <span>Ch</span>
                <span>an</span>
                <span>ge S </span>
                <span>ta</span>
                <span>tu</span>
                <span>s</span>
            </span>
        </button>
    </td>

    <div class="absolute"> say cheese</div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            meal_photo: "",
        };
    },
    created() {
        this.FormattedDate();
        this.truncatedIng();
    },
    methods: {
        FormattedDate(timestamp) {
            const date = new Date(timestamp);
            const formattedDate = `${date.getFullYear()}-${(date.getMonth() + 1)
                .toString()
                .padStart(2, "0")}-${date
                .getDate()
                .toString()
                .padStart(2, "0")}`;
            return formattedDate;
        },
        truncatedIng(description) {
            // Check if description exists and has more than 30 characters
            if (description && description.length > 1) {
                // Truncate description to 30 characters and add ellipsis
                return description.slice(0, 1) + "...";
            } else {
                // Return full description if it's less than or equal to 30 characters
                return description;
            }
        },
    },
};
</script>

<style scoped>
button:hover .span-mother {
    position: absolute;
}

button:hover .span-mother span {
    transform: translateY(1.3em);
}

button .span-mother span:nth-child(1) {
    transition: 0.2s;
}

button .span-mother span:nth-child(2) {
    transition: 0.3s;
}

button .span-mother span:nth-child(3) {
    transition: 0.4s;
}

button .span-mother span:nth-child(4) {
    transition: 0.5s;
}

button .span-mother span:nth-child(5) {
    transition: 0.6s;
}

button .span-mother span:nth-child(6) {
    transition: 0.7s;
}
button .span-mother2 {
    display: flex;
    position: absolute;
    overflow: hidden;
}

button .span-mother2 span {
    transform: translateY(-1.5em);
}

button:hover .span-mother2 span {
    transform: translateY(0);
}

button .span-mother2 span {
    transition: 0.2s;
}

button .span-mother2 span:nth-child(2) {
    transition: 0.3s;
}

button .span-mother2 span:nth-child(3) {
    transition: 0.4s;
}

button .span-mother2 span:nth-child(4) {
    transition: 0.5s;
}

button .span-mother2 span:nth-child(5) {
    transition: 0.6s;
}

button .span-mother2 span:nth-child(6) {
    transition: 0.7s;
}
</style>
