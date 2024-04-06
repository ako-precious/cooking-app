<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import SocialLogin from "./SocialLogin.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AppleLogo from "@/Components/AppleLogo.vue";
import GoogleLogo from "@/Components/GoogleLogo.vue";
import FacebookLogo from "@/Components/FacebookLogo.vue";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<script>
export default {
  methods: {
    openGoogleSignInPopup() {
      // Open the popup window
      const authWindow =  window.open("/auth/google/return", "GoogleSignInPopup", 'width=500,height=500' );
     
      // Check for successful authentication every second
      const interval = setInterval(() => {
        if (authWindow.closed || this.$page.props.auth.user.id) {
          clearInterval(interval);
          // Refresh the page after authentication is done
          window.location.reload();
        }
      }, 1000);

    },
    openFacebookSignInPopup() {

      // Open the popup window
      const authWindow =   window.open("/auth/facebook/return", "GoogleSignInPopup", 'width=500,height=500');
   
       // Check for successful authentication every second
       const interval = setInterval(() => {
        if (authWindow.closed || this.$page.props.auth.user.id) {
          clearInterval(interval);
          // Refresh the page after authentication is done
          window.location.reload();
        }
      }, 1000);

    }
  }
}
</script>


<template>
    <Head title="Register" />

    <AuthenticationCard>
        <template #logo>
            <!-- <AuthenticationCardLogo /> -->
        </template>

        <form @submit.prevent="submit">
            <div class="mt-4 group">
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4 group">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <div class="flex flex-col lg:flex-row justify-between">
                <div class="mt-4 group">
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="new-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4 group">
                    <InputLabel
                        for="password_confirmation"
                        value="Confirm Password"
                    />
                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        required
                        autocomplete="new-password"
                    />
                    <InputError
                        class="mt-2"
                        :message="form.errors.password_confirmation"
                    />
                </div>
            </div>

            <div
                v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature"
                class="mt-4"
            >
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox
                            id="terms"
                            v-model:checked="form.terms"
                            name="terms"
                            required
                        />

                        <div class="ms-2">
                            I agree to the
                            <a
                                target="_blank"
                                :href="route('terms.show')"
                                class="underline text-sm text-oynx active:text-polynesian hover:text-polynesian dark:text-snow dark:active:text-lighred dark:hover:text-lighred rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-polynesian dark:focus:ring-offset-lighred"
                                >Terms of Service</a
                            >
                            and
                            <a
                                target="_blank"
                                :href="route('policy.show')"
                                class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-polynesian dark:focus:ring-offset-lighred"
                                >Privacy Policy</a
                            >
                        </div>
                    </div>
                    <InputError class="mt-2" :message="form.errors.terms" />
                </InputLabel>
            </div>

            <div class="flex items-center justify-between mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-oynx active:text-polynesian hover:text-polynesian dark:text-snow dark:active:text-lighred dark:hover:text-lighred rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-polynesian dark:focus:ring-offset-lighred"
                >
                    Already registered?
                </Link>

                <PrimaryButton
                    class="ms-4 text-oynx dark:text-snow"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Register
                </PrimaryButton>
            </div>
            <div class="mt-4">
                <div class="flex items-center py-2">
                    <div class="bg-oynx dark:bg-snow w-full h-[1px]"></div>
                    <p class="text-oynx dark:text-snow w-full px-2 text-nowrap">
                        Or continue with
                    </p>
                    <div class="bg-oynx dark:bg-snow w-full h-[1px]"></div>
                </div>
                <div class="flex flex-col justify-between">
                    <div class="block my-3">
                        <a :href="route('auth.google')" @click.prevent="openGoogleSignInPopup">
                            <SocialLogin>
                                <template #logo>
                                    <GoogleLogo />
                                </template>
                                <template #name>
                                    Continue with Google
                                </template>
                            </SocialLogin>
                        </a>
                    </div>
                    <div class="block my-3">
                        <a :href="route('auth.facebook')" @click.prevent="openFacebookSignInPopup()">
                            <SocialLogin>
                                <template #logo>
                                    <FacebookLogo title="logo" />
                                </template>
                                <template #name>
                                    Continue with Facebook
                                </template>
                            </SocialLogin>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </AuthenticationCard>
</template>
