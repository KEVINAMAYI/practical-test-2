<script setup>
import {useAccommodationStore} from '../stores/AccommodationStore.js';
import {ref} from "vue";

const accommodationStore = useAccommodationStore()

const form = ref({
    name: '',
    description: '',
    country: '',
    city: '',
    address: '',
    standard_rack_rate: '',
});

</script>

<template>
    <main class="relative z-10">

        <div v-if="accommodationStore.isLoading" class="flex absolute pt-20 justify-center w-full z-30 mt-20">
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

            <div style="margin-top:20px;"  v-if="accommodationStore.success.message"
                 class="flex items-center w-3/4 mx-auto p-4 mb-3 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                 role="alert">
                <span class="font-medium"> {{ accommodationStore.success.message }}</span>
            </div>

            <div style="margin-top:20px;"  v-if="accommodationStore.errors.error"
                 class="flex items-center w-3/4  mx-auto p-4 mb-3 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                 role="alert">
                <span class="font-medium"> {{ accommodationStore.errors.error }}</span>
            </div>

            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-5">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Create Accommodation</h2>
                <form @submit.prevent="accommodationStore.addAccommodation(form)">
                    <div class="grid-cols-10  sm:gap-6">
                        <div class="w-full my-3">
                            <label for="name"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">                             Name</label>
                            <input  type="text" v-model="form.name" name="name" id="name"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="Villa Rosa" required="">
                            <p v-if="accommodationStore.errors.name"
                               class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                class="font-medium">{{ accommodationStore.errors.name[0] }}</span></p>
                        </div>
                        <div class="sm:col-span-2 my-3">
                            <label for="description"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" name="description" v-model="form.description" rows="5"
                                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                      placeholder="Your description here" required></textarea>
                            <p v-if="accommodationStore.errors.description"
                               class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                class="font-medium">{{ accommodationStore.errors.description[0] }}</span></p>

                        </div>
                        <div class="w-full my-3">
                            <label for="country"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Country</label>
                            <input type="text" v-model="form.country" name="country" id="country"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="Kenya" required="">
                            <p v-if="accommodationStore.errors.country"
                               class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                class="font-medium">{{ accommodationStore.errors.country[0] }}</span></p>
                        </div>
                        <div class="w-full my-3">
                            <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                            <input type="text" name="city" v-model="form.city" id="city"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="Nairobi" required="">
                            <p v-if="accommodationStore.errors.city"
                               class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                class="font-medium">{{ accommodationStore.errors.city[0] }}</span></p>
                        </div>
                        <div class="w-full my-3">
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                            <input type="text" name="address" v-model="form.address" id="address"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="438440-00100, Nairobi" required="">
                            <p v-if="accommodationStore.errors.address"
                               class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                class="font-medium">{{ accommodationStore.errors.address[0] }}</span></p>
                        </div>
                        <div class="w-full">
                            <label for="standard_rack_rate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Standard Rack Rate</label>
                            <input type="text" name="standard_rack_rate" v-model="form.standard_rack_rate" id="standard_rack_rate"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="KES 10000/day" required="">
                            <p v-if="accommodationStore.errors.standard_rack_rate"
                               class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                class="font-medium">{{ accommodationStore.errors.standard_rack_rate[0] }}</span></p>
                        </div>
                    </div>
                    <button type="submit"
                            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Create
                    </button>
                </form>
            </div>
        </section>
    </main>
</template>
