<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import DeleteUserForm from "@/Pages/Profile/Partials/DeleteUserForm.vue";
import LogoutOtherBrowserSessionsForm from "@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue";
import SectionBorder from "@/Components/SectionBorder.vue";
import TwoFactorAuthenticationForm from "@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue";
import UpdatePasswordForm from "@/Pages/Profile/Partials/UpdatePasswordForm.vue";
import UpdateProfileInformationForm from "@/Pages/Profile/Partials/UpdateProfileInformationForm.vue";

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>

<template>
    <AppLayout title="Profile">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-300 leading-tight"
            >
                Profile
            </h2>
        </template>

        <div class="md:grid md:grid-cols-4 md:gap-6">
            <div class=" col-span-1 w-full max-w-full py-6 sm:px-6 lg:px-0 ">
                <div
                    class="sticky flex flex-col min-w-0 break-words w-full  top-1/100 shadow-reverse dark:bg-slate-850  rounded-2xl bg-clip-border"
                >
                    <ul
                        class="flex  lg:flex-col flex-wrap p-4 mb-0 list-none rounded-xl"
                    >
                        <li class="pt-2">
                            <a
                                href="#profile"
                                class="flex items-center px-4 py-2 transition-colors ease-in-out rounded-lg group text-slate-500 hover:bg-gray-300"
                            >
                            <i
                                    class="mr-2 ni ni-books text-oynx opacity-60 dark:text-snow dark:group-hover:text-oynx"
                                ></i>
                                <span
                                    class="text-sm leading-normal dark:group-hover:text-oynx dark:text-snow"
                                    >Profile</span
                                >
                            </a>
                        </li>
                        <li class="pt-2">
                            <a
                                href="#password"
                                class="flex items-center px-4 py-2 transition-colors ease-in-out rounded-lg group text-slate-500 hover:bg-gray-300"
                            >
                                <i
                                    class="mr-2 ni ni-atom text-oynx opacity-60 dark:text-snow dark:group-hover:text-oynx"
                                ></i>
                                <span
                                    class="text-sm leading-normal dark:group-hover:text-oynx dark:text-snow"
                                    >Change Password</span
                                >
                            </a>
                        </li>
                        <li class="pt-2">
                            <a
                                href="#2FA"
                                class="flex items-center px-4 py-2 transition-colors ease-in-out rounded-lg group text-slate-500 hover:bg-gray-300"
                            >
                                <i
                                    class="mr-2 ni ni-ui-04 text-oynx opacity-60 dark:text-snow dark:group-hover:text-oynx"
                                ></i>
                                <span
                                    class="text-sm leading-normal dark:group-hover:text-oynx dark:text-snow"
                                    >2FA</span
                                >
                            </a>
                        </li>
                       
                        <li class="pt-2">
                            <a
                                href="#sessions"
                                class="flex items-center px-4 py-2 transition-colors ease-in-out rounded-lg group text-slate-500 hover:bg-gray-300"
                            >
                                <i
                                    class="mr-2 ni ni-watch-time text-oynx opacity-60 dark:text-snow dark:group-hover:text-oynx"
                                ></i>
                                <span
                                    class="text-sm leading-normal dark:group-hover:text-oynx dark:text-snow"
                                    >Sessions</span
                                >
                            </a>
                        </li>
                        <li class="pt-2">
                            <a
                                href="#delete"
                                class="flex items-center px-4 py-2 transition-colors ease-in-out rounded-lg group text-slate-500 hover:bg-gray-300"
                            >
                                <i
                                    class="mr-2 ni ni-settings-gear-65 text-oynx opacity-60 dark:text-snow dark:group-hover:text-oynx"
                                ></i>
                                <span
                                    class="text-sm leading-normal dark:group-hover:text-oynx dark:text-snow"
                                    >Delete Account</span
                                >
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-span-3 max-w-7xl mx-auto py-6 sm:px-6 ">
                <div v-if="$page.props.jetstream.canUpdateProfileInformation" id="profile">
                    <UpdateProfileInformationForm
                        :user="$page.props.auth.user"/>

                    <SectionBorder />
                </div>

                <div v-if="$page.props.jetstream.canUpdatePassword" id="password">
                    <UpdatePasswordForm class="mt-10 sm:mt-0" />

                    <SectionBorder />
                </div>

                <div id="2FA"
                    v-if="$page.props.jetstream.canManageTwoFactorAuthentication"
                >
                    <TwoFactorAuthenticationForm
                        :requires-confirmation="confirmsTwoFactorAuthentication"
                        class="mt-10 sm:mt-0"/>

                    <SectionBorder />
                </div>

                <LogoutOtherBrowserSessionsForm id="sessions"
                    :sessions="sessions"
                    class="mt-10 sm:mt-0"/>

                <template 
                    v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                    <SectionBorder />

                    <DeleteUserForm id="delete" class="mt-10 sm:mt-0" />
                </template>
            </div>
        </div>
    </AppLayout>
</template>
