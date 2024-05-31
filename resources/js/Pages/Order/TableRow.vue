<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps(["meal"]);
</script>
<template>
    <td class="whitespace-nowrap pl-6 py-3 font-bold">
       {{meal.id}}
    </td>
    <td class="whitespace-nowrap px-6 py-3 font-bold">
        <Link  :href="`/cook/order/${meal.id}`"  class="flex items-center j">
            <div class="w-16 h-16">
                <img
                    :src="meal_photo"
                    :alt="meal_photo"
                    class="w-full h-full object-cover rounded"
                />
            </div>
            <p class="pl-4 lg:pl-8">
                {{ meal.meal.name }}
            </p>
        </Link>
    </td>
 
    <td class="whitespace-nowrap px-6 py-3 font-semibold">
        {{ meal.meal_time }}
    </td>
    <td class="whitespace-nowrap px-6 py-3 font-semibold">
        {{ meal.start_date }}
    </td>
    <td class="whitespace-nowrap px-6 py-3 font-semibold">
        {{ FormattedDate(meal.created_at) }}
    </td>

    <td class="whitespace-nowrap px-6 py-3 text-center font-semibold">
        <div class="flex items-center">
            <p>
                {{ meal.status }}
            </p>
        </div>
    </td>
    

  
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            meal_photo: "",
            user_name: "",
            message: "",
            error: "",
          
        };
    },
    created() {
        this.FormattedDate();
        this.truncatedIng();
        this.getImage();
    },
   
    methods: {
       
        getImage() {
            const id = this.meal.meal.id;
            axios
                .get(`/meal_photos/${id}`)
                .then((response) => {
                    if (response.data.firstPhoto.meal_photo_path) {
                        this.meal_photo =
                            `/storage/${response.data.firstPhoto.meal_photo_path}`.replace(
                                "/public",
                                ""
                            );
                    }
                })
                .catch((error) => {
                    // Handle error
                    // console.error("Error saving data:", error);
                });
        },
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
        getCook(id) {
            axios
                .get("/meal/" + id)
                .then((response) => {
                    // console.log("Data sent successfully:", response.data.meal);
                    this.user_name = response.data.meal.user.name;
                })
                .catch((error) => {
                    console.error("Error sending data:", error);
                });
            return this.user_name;
        },
        ChangeStatus(status) {
            axios
                .put("/cook/order/" + this.meal.id, { status })
                .then((response) => {
                    console.log(
                        "Data sent successfully:",
                        response.data.order.status
                    );
                    // this.meal.status = response.data.order.status
                })
                .catch((error) => {
                    console.error("Error sending data:", error);
                });
        },

        addRating() {
            if (
                this.newRating.presentation == "Choose a rating" ||
                this.newRating.taste == "Choose a rating" ||
                this.newRating.value == "Choose a rating" ||
                this.newRating.nutrition == "Choose a rating" ||
                this.newRating.portion_size == "Choose a rating" ||
                this.newRating.freshness == "Choose a rating" ||
                this.newRating.comment == ""
            ) {
                this.error =
                    "Please fill in all  fields to create your schedule.";
            } else {
                axios
                    .post("api/rating", this.newRating)
                    .then((resp) => {
                        this.message = resp.data.message;

                        setTimeout(() => {
                            this.closeModal();
                            // Uncomment the line below if you want to toggle addingMode after the delay
                            // this.addingMode = !this.addingMode;
                        }, 5000);
                    })
                    .catch((err) => {
                        console.log(err);
                        this.error = "Unable to add Meal !";
                        setTimeout(() => {
                            this.error = "";
                        }, 10000);
                    });
            }
        },

        openModal(meal) {

            axios
                .get("/api/rating", {params: {
        meal_id: this.meal.id,
        user_id: this.$page.props.auth.user.id,
    }
                })
                .then((resp) => {
                    if (resp.data) {
                        this.newRating = resp.data.rating;
                        // console.log(resp);
                        if (this.newRating == null) {
                            this.newRating = {
                                meal_id: this.meal.meal.id,
                                user_id: this.$page.props.auth.user.id,
                                presentation: 0,
                                taste: 0,
                                value: 0,
                                nutrition: 0,
                                portion_size: 0,
                                freshness: 0,
                                comment: "",
                            };
                        }
                    } else {
                        this.newRating = {
                            meal_id: this.meal.meal.id,
                            user_id: this.$page.props.auth.user.id,
                            presentation: 0,
                            taste: 0,
                            value: 0,
                            nutrition: 0,
                            portion_size: 0,
                            freshness: 0,
                            comment: "",
                        };
                    }
                })
                .catch((err) => {
                    // console.log(err);
                    this.error = "Unable to add Meal !";
                    // setTimeout(() => {
                    //     this.error = "";
                    // }, 10000);
                });

            this.newEventModalVisible = true;
        },
        closeModal() {
            // clear everything in the div and close it
            this.newEventModalVisible = false;
            this.newRating = {
                meal_id: "",
                user_id: "",
                presentation: 0,
                taste: 0,
                value: 0,
                nutrition: 0,
                portion_size: 0,
                freshness: 0,
                comment: "",
            };
            this.message = "";
            this.error = "";
        },
    },
};
</script>
