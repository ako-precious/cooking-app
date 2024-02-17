<script setup>
defineProps(["meal"]);
</script>
<template>
    <td v-if="meal.name" class="whitespace-nowrap px-6 py-4 font-medium">
        {{ meal.name }}
    </td>
    <td v-else class="whitespace-nowrap px-6 py-4 font-medium">
        Meal created on {{ FormattedDate(meal.created_at) }}
    </td>
    <td class="whitespace-nowrap px-6 py-4">{{   truncatedDescription(meal.description)  }}</td>
    <td class="whitespace-nowrap px-6 py-4">$ {{ meal.price }}</td>
    <td class="whitespace-nowrap px-6 py-4">{{ truncatedIng(meal.ingredients)  }}</td>
    <td class="whitespace-nowrap px-6 py-4">Cell</td>
    <td class="whitespace-nowrap px-6 py-4">Cell</td>
    <td class="whitespace-nowrap px-6 py-4">Cell</td>
    <td class="whitespace-nowrap px-6 py-4">Cell</td>
    <td class="whitespace-nowrap px-6 py-4">Cell</td>
</template>

<script>
export default {
    created() {
        this.FormattedDate(); this.truncatedDescription(); this.truncatedIng()
    },
    computed: {
    
  },
    methods: {
        FormattedDate(timestamp) {
            const date = new Date(timestamp);
            const formattedDate = `${date.getFullYear()}-${(date.getMonth() + 1)
                .toString()
                .padStart(2, "0")}-${date
                .getDate()
                .toString()
                .padStart(2, "0")} at ${date.getHours()}:${date
                .getMinutes()
                .toString()
                .padStart(2, "0")}`;
            return formattedDate;
        },
        truncatedDescription(description) {
            // Check if description exists and has more than 30 characters
            if (description &&
                description.length > 30) {
                // Truncate description to 30 characters and add ellipsis
                return description.slice(0, 3) + "...";
            } else {
                // Return full description if it's less than or equal to 30 characters
                return description;
            }
        },
        truncatedIng(description) {
            // Check if description exists and has more than 30 characters
            if (description &&
                description.length > 2) {
                // Truncate description to 30 characters and add ellipsis
                return description.slice(0, 2) + "...";
            } else {
                // Return full description if it's less than or equal to 30 characters
                return description;
            }
        },
    },
};
</script>
