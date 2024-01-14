<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import GoogleLogo from "@/Components/GoogleLogo.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";

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

<template>
    <Head title="Log in" />

    <AuthenticationCard >
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div
            v-if="status"
            class="mb-4 font-medium text-sm text-green-600 dark:text-green-400"
        >
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div  class="mt-4 group">
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
                    class="w-full mb-2"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Sign in
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
                <div class="flex justify-between">
                    <div class="block">
                        <a href="#"
                            ><PrimaryButton disabled class="w-full flex">
                                <p class="flex items-center text-sm">
                                    <GoogleLogo />
                                    Google
                                </p>
                            </PrimaryButton></a
                        >
                    </div>
                    <div class="block">
                        <a href="#"
                            ><PrimaryButton disabled class="w-full flex">
                                <p class="flex items-center text-sm">
                                    <GoogleLogo />
                                    Google
                                </p>
                            </PrimaryButton></a
                        >
                    </div>
                    <div class="block">
                        <a href="#"
                            ><PrimaryButton disabled class="w-full flex">
                                <p class="flex items-center text-sm">
                                    <GoogleLogo />
                                    Google
                                </p>
                            </PrimaryButton></a
                        >
                    </div>
                </div>
            </div>
        </form>
    </AuthenticationCard>
</template>
