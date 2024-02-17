<script setup>
defineProps(["meal"]);
</script>
<template>
    <td v-if="meal.name" class="whitespace-nowrap px-6 py-4 font-semibold">
        {{ meal.name }}
    </td>
    <td v-else class="whitespace-nowrap px-6 py-4 font-semibold">
        Meal created on {{ FormattedDate(meal.created_at) }}
    </td>
    <td class="whitespace-nowrap px-6 py-4">{{ meal.status }}</td>
    <td class="whitespace-nowrap px-6 py-4">$ {{ meal.price }}</td>
    <td class="whitespace-nowrap px-6 py-4 text-center">{{ meal.ordering_preferences }}</td>
    <td class="whitespace-nowrap px-6 py-4">{{ truncatedIng(meal.ingredients)  }}</td>
    <td class="whitespace-nowrap px-6 py-4">Cell</td>
    <td class="whitespace-nowrap px-6 py-4">Cell</td>
    <td class="whitespace-nowrap px-6 py-4">Cell</td>
</template>

<script>
export default {
    created() {
        this.FormattedDate(); this.truncatedIng()
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
                .padStart(2, "0")}`;
            return formattedDate;
        },
        
        truncatedIng(description) {
            // Check if description exists and has more than 30 characters
            if (description &&
                description.length > 1) {
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
