<script setup>
import { ref } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import axios from "axios";
const props = defineProps({
    user: Object,
});

let suggestions = [];
let debounceTimer = null;
// const ingredients = ref([]);

const form = useForm({
    _method: "PUT",
    name: props.user.name,
    email: props.user.email,
    phone_number: props.user.phone_number,
    address: props.user.address,
    dietary_restrictions_allergies: props.user.dietary_restrictions_allergies,
    other_info: props.user.other_info,
    photo: null,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }
    form.post(route("user-profile-information.update"), {
        errorBag: "updateProfileInformation",
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (!photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    router.delete(route("current-user-photo.destroy"), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};

const addItem = () => {
    form.dietary_restrictions_allergies.push("");
};

const removeItem = (index) => {
    form.dietary_restrictions_allergies.splice(index, 1);
};

const debouncedFetchSuggestions = () => {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(() => {
        if (form.address.length >= 3) {
            const params = {
                input: form.address,
                // key: "" // Replace with your API key
            };
            axios
                .get("/maps/place/autocomplete", { params })
                .then((response) => {
                    suggestions = response.data.predictions;
                    console.log(response.data);
                })
                .catch((error) => {
                    console.error("Error fetching suggestions:", error);
                    suggestions = [];
                });
        } else {
            suggestions = []; // Clear suggestions if input is less than 3 characters
        }
    }, 300); // Debounce time: 300ms
};

const fetchSuggestions = () => {
    // Call debouncedFetchSuggestions method
    debouncedFetchSuggestions();
};

const selectSuggestion = (suggestion) => {
    form.address = suggestion.description;
    suggestions = []; // Clear suggestions on selection
    // Optionally fetch more details using the Place Details API
    // fetchPlaceDetails(suggestion.place_id);
};
// const debouncedFetchSuggestions = () => {
//       clearTimeout(this.debounceTimer);
//       this.debounceTimer = setTimeout(() => {
//         if (this.form.address.length >= 3) {
//           const params = {
//             input: this.form.address,
//             key: "AIzaSyDdY5XR6f2xNtf89VzDQZZzLcYQQROwX5g" // Replace with your API key
//           };
//           axios
//             .get("https://maps.googleapis.com/maps/api/place/autocomplete/json", { params })
//             .then((response) => {
//               this.suggestions = response.data.predictions;
//             })
//             .catch((error) => {
//               console.error("Error fetching suggestions:", error);
//               this.suggestions = [];
//             });
//         } else {
//           this.suggestions = []; // Clear suggestions if input is less than 3 characters
//         }
//       }, 300); // Debounce time: 300ms
//     };

//    const fetchSuggestions = () => {
//       // Call debouncedFetchSuggestions method
//       this.debouncedFetchSuggestions();
//     };
//    const  selectSuggestion = (suggestion) =>{
//       this.form.address = suggestion.description;
//       this.suggestions = []; // Clear suggestions on selection
//       // Optionally fetch more details using the Place Details API
//       // this.fetchPlaceDetails(suggestion.place_id);
//     }
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title> Profile Information </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div
                v-if="$page.props.jetstream.managesProfilePhotos"
                class="col-span-6 sm:col-span-6 flex justify-center"
            >
                <div>
                    <!-- Profile Photo File Input -->
                    <input
                        id="photo"
                        ref="photoInput"
                        type="file"
                        class="hidden"
                        @change="updatePhotoPreview"
                    />

                    <!-- Current Profile Photo -->
                    <div
                        v-show="!photoPreview"
                        class="mt-2 flex justify-center"
                    >
                        <img
                            :src="user.profile_photo_url"
                            :alt="user.name"
                            class="rounded-full h-20 w-20 object-cover"
                        />
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div v-show="photoPreview" class="mt-2">
                        <span
                            class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                            :style="
                                'background-image: url(\'' +
                                photoPreview +
                                '\');'
                            "
                        />
                    </div>

                    <PrimaryButton
                        class="mt-2 me-2"
                        type="button"
                        @click.prevent="selectNewPhoto"
                    >
                        Select A New Photo
                    </PrimaryButton>

                    <SecondaryButton
                        v-if="user.profile_photo_path"
                        type="button"
                        class="mt-2"
                        @click.prevent="deletePhoto"
                    >
                        Remove Photo
                    </SecondaryButton>

                    <InputError :message="form.errors.photo" class="mt-2" />
                </div>
            </div>

            <!-- Name -->
            <div class="col-span-6">
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full capitalize"
                    required
                    autocomplete="name"
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6">
                <div class="flex flex-col lg:flex-row justify-between">
                    <div class="w-full mb-[1.5rem] lg:mb-0 lg:w-[48%]">
                        <InputLabel for="email" value="Email" />
                        <TextInput
                            id="email"
                            v-model="form.email"
                            type="email"
                            readonly
                            class="mt-1 block w-full text-sm"
                            required
                            autocomplete="username"
                        />
                        <InputError :message="form.errors.email" class="mt-2" />

                        <div
                            v-if="
                                $page.props.jetstream.hasEmailVerification &&
                                user.email_verified_at === null
                            "
                        >
                            <p class="text-sm mt-2 dark:text-white">
                                Your email address is unverified.

                                <Link
                                    :href="route('verification.send')"
                                    method="post"
                                    as="button"
                                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                    @click.prevent="sendEmailVerification"
                                >
                                    Click here to re-send the verification
                                    email.
                                </Link>
                            </p>

                            <div
                                v-show="verificationLinkSent"
                                class="mt-2 font-medium text-sm text-green-600 dark:text-green-400"
                            >
                                A new verification link has been sent to your
                                email address.
                            </div>
                        </div>
                    </div>
                    <!-- Phone -->
                    <div class="w-full mb-[1.5rem] lg:mb-0 lg:w-[48%]">
                        <InputLabel for="Phone Number" value="Phone Number" />
                        <TextInput
                            id="phone_number"
                            v-model="form.phone_number"
                            type="text"
                            class="mt-1 block w-full"
                            required
                            autocomplete="phone_number"
                        />
                        <InputError
                            :message="form.errors.phone_number"
                            class="mt-2"
                        />
                    </div>
                </div>
            </div>

            <!-- Address -->
          <div class="col-span-6 relative">
                <InputLabel for="address" value="Address" />
                <TextInput
                    id="address"
                    v-model="form.address"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="address"
                    @keyup.enter="fetchSuggestions"
                    @input="debouncedFetchSuggestions"
                />
                <InputError :message="form.errors.address" class="mt-2" />
                <ul class="absolute shadow-small p-2 w-full rounded-md" v-if="suggestions.length">
                    <li class="p-1"
                        v-for="suggestion in suggestions"
                        :key="suggestion.place_id"
                    >
                        <a href="#" @click="selectSuggestion(suggestion)">
                            {{ suggestion.description }}
                        </a>
                    </li>
                </ul>
            </div>
            <!-- dietary_restriction_allergies -->
            <div class="col-span-6">
                <div class="flex items-center justify-between">
                    <InputLabel
                        for=""
                        value="Dietary Restriction and Allergies"
                    />
                    <p
                        class="bg-snow/50 cursor-pointer p-1 text-sm"
                        @click="addItem"
                        title="add Dietary Restriction and Allergies "
                    >
                        Add
                        <font-awesome-icon icon="plus" class="text-persian" />
                    </p>
                </div>

                <div class="mt-1">
                    <div class="flex flex-wrap-reverse flex-row-reverse">
                        <div
                            class="relative sm:w-1/3 p-1"
                            v-for="(
                                item, index
                            ) in form.dietary_restrictions_allergies"
                            :key="index"
                        >
                            <TextInput
                                class="block w-full h-full text-sm"
                                v-model="
                                    form.dietary_restrictions_allergies[index]
                                "
                            />
                            <p
                                class="absolute bottom-1 top-1 right-1 bg-snow/20 cursor-pointer p-2"
                                @click="removeItem(index)"
                            >
                                <font-awesome-icon
                                    icon="fa-solid fa-close"
                                    class="text-persian text-"
                                />
                            </p>
                        </div>
                    </div>
                </div>
                <InputError
                    :message="form.errors.dietary_restrictions_allergies"
                    class="mt-2"
                />
            </div>

            <!-- other info -->
            <div class="col-span-6">
                <InputLabel
                    for="other_info"
                    value="Something Interesting about you"
                />

                <textarea
                    autocomplete="other_info"
                    id="other_info"
                    class="mt-1 block w-full disable-scrollbars border-oynx bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37] focus:shadow-none dark:focus:shadow-none dark:shadow-oynx-sm dark:border-snow focus:border-polynesian dark:focus:border-lighred focus:ring-polynesian dark:focus:ring-lighred rounded-md text-oynx dark:text-snow"
                    rows="4"
                    cols="50"
                    v-model="form.other_info"
                ></textarea>
                <InputError :message="form.errors.other_info" class="mt-2" />
            </div>

            <!-- <div class="col-span-6 sm:col-span-4">
             
            </div> -->
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="me-3">
                Saved.
            </ActionMessage>

            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Save
            </PrimaryButton>
        </template>
    </FormSection>
</template>
<!-- {/* <script>
import axios from "axios";

export default {
  data() {
    return {
      suggestions: [],
    };
  },
  mounted(){
    console.log(this.form.address);
  },
  methods: {
    debouncedFetchSuggestions() {
      clearTimeout(this.debounceTimer);
      this.debounceTimer = setTimeout(() => {
        if (this.form.address.length >= 3) {
          const params = {
            input: this.form.address,
            key: "YOUR_API_KEY" // Replace with your API key
          };
          axios
            .get("https://maps.googleapis.com/maps/api/place/autocomplete/json", { params })
            .then((response) => {
              this.suggestions = response.data.predictions;
            })
            .catch((error) => {
              console.error("Error fetching suggestions:", error);
              this.suggestions = [];
            });
        } else {
          this.suggestions = []; // Clear suggestions if input is less than 3 characters
        }
      }, 300); // Debounce time: 300ms
    },
    fetchSuggestions() {
      // Call debouncedFetchSuggestions method
      this.debouncedFetchSuggestions();
    },
    selectSuggestion(suggestion) {
      this.form.address = suggestion.description;
      this.suggestions = []; // Clear suggestions on selection
      // Optionally fetch more details using the Place Details API
      // this.fetchPlaceDetails(suggestion.place_id);
    },
    // fetchPlaceDetails(placeId) {
    //   // Fetch details using Place Details API
    // },
  },
};
</script>
 <script>
import axios from "axios";

export default {
    data() {
        return {
            address: '',
            suggestions: [],
        };
    },
    methods: {
        fetchSuggestions() {
            if (this.form.address.length >= 3) {
                console.log(this.form.address);
                const params = {
                    input: this.form.address,
                    key: AIzaSyDdY5XR6f2xNtf89VzDQZZzLcYQQROwX5g, // Replace with your API key
                };
                axios
                    .get(
                        "https://maps.googleapis.com/maps/api/place/autocomplete/json",
                        { params }
                    )
                    .then((response) => {
                        this.suggestions = response.data.predictions;
                    })
                    .catch((error) => {
                        console.error("Error fetching suggestions:", error);
                    });
            } else {
                this.suggestions = []; // Clear suggestions if input is less than 3 characters
            }
        },
        selectSuggestion(suggestion) {
            this.form.address = suggestion.description;
            this.suggestions = []; // Clear suggestions on selection

            // Optional: Server-side validation/formatting
            if (this.shouldValidateAddress) {
                // Flag to check if server-side validation is enabled
                this.validateAddress(this.form.address);
            }
        },
        validateAddress(address) {
            // Implement logic to send address to Laravel controller for validation
            // (if server-side validation is enabled)
        },
    },
    computed: {
        shouldValidateAddress() {
            // Set a flag to determine if server-side validation is enabled
            return false; // Change to true if you want server-side validation
        },
    },
};
</script>  */} -->
