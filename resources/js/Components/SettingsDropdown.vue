<script setup>
import DropdownLink from "@/Components/DropdownLink.vue";
import Dropdown from "@/Components/Dropdown.vue";
const logout = () => {
    router.post(route("logout"));
};
</script>

<template>
 <!-- Settings Dropdown -->
 <div  class="ml-2  lg:mr-4 relative text-oynx active:text-persian hover:text-polynesian dark:text-snow dark:active:text-persian dark:hover:text-lighred rounded-full  bg-gradient-to-br from-[#e3dedf] to-[#ffffff] shadow-snow-md hover:shadow-snow-sm focus:shadow-none active:shadow-none hover:border-polynesian dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37]  dark:shadow-oynx-md hover:dark:shadow-oynx-sm active:dark:shadow-none z-20 transition-all duration-250 ease-in">
                                        <Dropdown align="right" width="48">
                                           <template #trigger>
                                               <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                   <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                                               </button>
        
                                               <span v-else class="inline-flex rounded-md">
                                                   <button type="button" class="inline-flex items-center px-3 py-3 border border-transparent text-sm leading-4 font-medium rounded-full  transition ease-in-out duration-150">
                                                       {{truncatedIng($page.props.auth.user.name)  }} 
                                                       <font-awesome-icon
                                        icon="caret-down"
                                        class="h-3 lg:h-4 ml-2 svg-inline--fa fa-user fa-w-14 fa-9x"
                                    />
                                                   </button>
                                               </span>
                                           </template>
        
                                           <template #content class=" bg-snow dark:bg-oynx">
                                            <div class="origin-top-right absolute right-0 mt-2 w-48 delay-75 rounded-md border-snow  ring-1 bg-gradient-to-br from-[#e3dedf] to-[#ffffff] -shadow-snow-sm hover:shadow-snow-sm dark:bg-gradient-to-br dark:from-[#2b312e] dark:to-[#333a37]  dark:-shadow-oynx-sm hover:dark:shadow-oynx-sm z-20 transition-all duration-250 ease-in dark:border-oynx"
             >
                                                <!-- Account Management -->
                                                <div class="block px-4 py-2 text-xs text-gray-600">
                                                    Manage Account
                                                </div>
         
                                                <DropdownLink :href="route('profile.show')">
                                                    Profile
                                                </DropdownLink>
         
                                                <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                                                    API Tokens
                                                </DropdownLink>
         
                                                <div class="border-t border-gray-200 dark:border-gray-600" />
         
                                                <!-- Authentication -->
                                                <form @submit.prevent="logout">
                                                    <DropdownLink as="button">
                                                        Log Out
                                                    </DropdownLink>
                                                </form>
                                                     <!-- Add the toggle bo ttuns later -->
                                            </div>
                                           </template>
                                       </Dropdown>
                                   </div>
</template>


