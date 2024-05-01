<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import AppleLogo from "@/Components/AppleLogo.vue";
import GoogleLogo from "@/Components/GoogleLogo.vue";
import FacebookLogo from "@/Components/FacebookLogo.vue";
import MicrosoftLogo from "@/Components/MicrosoftLogo.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import SocialLogin from "./SocialLogin.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>
<script>
export default {
    data() {
        return {
            auth: false,
            user: ''

        };
    },
  methods: {
    openGoogleSignInPopup() {
      // Open the popup window
      const authWindow =  window.open("/auth/google/return", "GoogleSignInPopup", 'width=500,height=500' );

      axios
                    .get("/auth/google/callback")
                    .then((response) => {
                       this.user =  response.data.user.id;

                        this.auth = true
                    
                    })
                    .catch((error) => {
                        // Handle error
                        // console.error("Error saving data:", error);
                    });
                    const interval = setInterval(() => {
                          if (authWindow.closed || response.data.user.id) {
                            clearInterval(interval);
                            // Refresh the page after authentication is done
                            window.location.reload();
                          }
                        }, 1000);
                        // this.$inertia.visit(
                        //     `/become-a-cook/${MealId}/spotlight`
                        // );
      // Check for successful authentication every second

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

    },
    openMicrosoftSignInPopup() {

      // Open the popup window
      const authWindow =   window.open("/auth/microsoft/return", "MicroSignInPopup", 'width=500,height=500');

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
    <Head title="Sign in" />

    <AuthenticationCard>
        <div
            v-if="status"
            class="mb-4 font-medium text-sm text-green-600 dark:text-green-400"
        >
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 group">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4 group">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex items-center justify-between mt-2 py-2">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-oynx active:text-polynesian hover:text-polynesian dark:text-snow dark:active:text-lighred dark:hover:text-lighred rounded-md"
                >
                    Forgot your password?
                </Link>
                <label class="flex items-center">
                    <Checkbox v-model:checked="form.remember" name="remember" />
                    <span
                        class="ms-2 text-sm text-oynx active:text-polynesian hover:text-polynesian dark:text-snow dark:active:text-lighred dark:hover:text-lighred"
                        >Remember me</span
                    >
                </label>
            </div>
            <div class="block">
                <PrimaryButton
                    class="w-full mb-2 text-oynx dark:text-snow"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Sign in
                </PrimaryButton>
            </div>
            <div class="my-4">
                <div class="flex items-center py-2">
                    <div class="bg-oynx dark:bg-snow w-full h-[1px]"></div>
                    <p class="text-oynx dark:text-snow w-full px-2 text-nowrap">
                        Or continue with
                    </p>
                    <div class="bg-oynx dark:bg-snow w-full h-[1px]"></div>
                </div>
                <div class="flex flex-col justify-between">
                    <div class="block my-3">
                        <a
                            :href="route('auth.google')"
                            @click.prevent="openGoogleSignInPopup"
                        >
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
                    <!-- <div class="block my-3">
                        <a :href="route('auth.microsoft')" target="_blank" >
                            <SocialLogin>
                                <template #logo>
                                    <MicrosoftLogo title="logo" />
                                </template>
                                <template #name>
                                    Continue with Microsoft
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
                    </div> -->
                </div>
            </div>
        </form>
    </AuthenticationCard>
</template>
