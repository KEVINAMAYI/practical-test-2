<script setup>
import {useTravelAgentStore} from '../stores/TravelAgentStore.js';
import {onMounted, ref} from "vue";

const props = defineProps(['travelAgentID'])

const travelAgentStore = useTravelAgentStore()

onMounted(()=>{
    travelAgentStore.getTravelAgent(props.travelAgentID)
})

</script>

<template>
    <main class="relative z-10">

        <div v-if="travelAgentStore.isLoading" class="flex absolute pt-20 justify-center w-full z-30 mt-20">
            <div role="status">
                <svg aria-hidden="true" class="w-12 h-12 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                     viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor"/>
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <section class="bg-white dark:bg-gray-900">

            <div v-if="travelAgentStore.success.message"
                 class="flex items-center w-1/2 mx-auto p-4 mb-3 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                 role="alert">
                <span class="font-medium"> {{ travelAgentStore.success.message }}</span>
            </div>

            <div v-if="travelAgentStore.errors.error"
                 class="flex items-center w-1/2 mx-auto p-4 mb-3 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                 role="alert">
                <span class="font-medium"> {{ travelAgentStore.errors.error }}</span>
            </div>

            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-5">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Travel Agent</h2>
                <form @submit.prevent="travelAgentStore.updateTravelAgent()">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">

                        <div class="w-full">
                            <label for="last_name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First
                                Name</label>
                            <input type="text" v-model="travelAgentStore.travelAgent.user.first_name" name="last_name" id=""
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="Amayi" required="">
                            <p v-if="travelAgentStore.errors.first_name"
                               class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                class="font-medium">{{ travelAgentStore.errors.first_name[0] }}</span></p>
                        </div>
                        <div class="w-full">
                            <label for="last_name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last
                                Name</label>
                            <input type="text" v-model="travelAgentStore.travelAgent.user.last_name" name="last_name" id="last_name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="Amayi" required="">
                            <p v-if="travelAgentStore.errors.last_name"
                               class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                class="font-medium">{{ travelAgentStore.errors.last_name[0] }}</span></p>
                        </div>
                        <div class="w-full">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" v-model="travelAgentStore.travelAgent.user.email" id="email"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="kevinamayi20@gmail.com" required="">
                            <p v-if="travelAgentStore.errors.email"
                               class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                class="font-medium">{{ travelAgentStore.errors.email[0] }}</span></p>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="experience"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Experience</label>
                            <textarea id="experience" name="experience" v-model="travelAgentStore.travelAgent.experience" rows="5"
                                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                      placeholder="Your experience here"></textarea>
                            <p v-if="travelAgentStore.errors.experience"
                               class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                class="font-medium">{{ travelAgentStore.errors.experience[0] }}</span></p>

                        </div>
                        <div class="sm:col-span-2">
                            <label for="about_me"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">About
                                Me</label>
                            <textarea id="about_me" name="about_me" rows="5" v-model="travelAgentStore.travelAgent.about_me"
                                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                      placeholder="About travel agent here"></textarea>
                            <p v-if="travelAgentStore.errors.about_me"
                               class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                class="font-medium">{{ travelAgentStore.errors.about_me[0] }}</span></p>


                        </div>
                    </div>
                    <button type="submit"
                            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Update
                    </button>
                </form>
            </div>
        </section>
    </main>
</template>
