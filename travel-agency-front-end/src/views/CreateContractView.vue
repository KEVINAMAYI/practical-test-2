<script setup>
import {useContractStore} from '../stores/ContractStore.js';
import {useTravelAgentStore} from '../stores/TravelAgentStore.js';
import {onMounted, ref} from "vue";

const contractStore = useContractStore()
const travelAgentStore = useTravelAgentStore()


const form = ref({
    contract_number: "",
    travel_agent_id: "",
    exclusive: "",
    start_date: "",
    end_date: "",
    description: "",
    standard_rate: "",
})

onMounted(()=>{
    travelAgentStore.getTravelAgents()
})


</script>

<template>
    <main class="relative z-10">

        <div v-if="contractStore.isLoading" class="flex absolute pt-20 justify-center w-full z-30 mt-20">
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

            <div style="margin-top:20px;"  v-if="contractStore.success.message"
                 class="flex items-center w-3/4  mx-auto p-4 mb-3 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                 role="alert">
                <span class="font-medium"> {{ contractStore.success.message }}</span>
            </div>

            <div style="margin-top:20px;"  v-if="contractStore.errors.error"
                 class="flex items-center w-3/4 mx-auto p-4 mb-3 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                 role="alert">
                <span class="font-medium"> {{ contractStore.errors.error }}</span>
            </div>

            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-5">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Create Contract</h2>
                <form @submit.prevent="contractStore.addContract(form)">
                    <div class="grid sm:col-span-2 sm:gap-6">
                        <div class="w-full">
                            <label for="contract_number"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Contract Number</label>
                            <input type="text" v-model="form.contract_number" name="contract_number" id="contract_number"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="34643511" required="">
                            <p v-if="contractStore.errors.contract_number"
                               class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                class="font-medium">{{ contractStore.errors.contract_number[0] }}</span></p>
                        </div>
                        <div class="w-full">
                            <label for="travel_agent_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Travel Agent</label>
                            <select id="travel_agent_id" v-model="form.travel_agent_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option v-for="travelAgent in travelAgentStore.travelAgents" :key="travelAgent.id" :value="travelAgent.id">{{ travelAgent.user.first_name }} {{ travelAgent.user.last_name }}</option>
                            </select>
                            <p v-if="contractStore.errors.travel_agent_id"
                               class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                class="font-medium">{{ contractStore.errors.travel_agent_id[0] }}</span></p>
                        </div>
                        <div class="w-full">
                            <label for="start_date"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Start Date</label>
                            <input type="date" v-model="form.start_date" name="start_date" id="start_date"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="Kenya" required="">
                            <p v-if="contractStore.errors.start_date"
                               class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                class="font-medium">{{ contractStore.errors.start_date[0] }}</span></p>
                        </div>
                        <div class="w-full">
                            <label for="end_date"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                End Date</label>
                            <input type="date" v-model="form.end_date" name="end_date" id="end_date"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="Kenya" required="">
                            <p v-if="contractStore.errors.end_date"
                               class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                class="font-medium">{{ contractStore.errors.end_date[0] }}</span></p>
                        </div>
                        <div class="w-full">
                            <label for="exclusive" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Exclusive</label>
                            <select required id="exclusive" v-model="form.exclusive" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            <p v-if="contractStore.errors.end_date"
                               class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                class="font-medium">{{ contractStore.errors.end_date[0] }}</span></p>
                        </div>
                        <div class="w-full">
                            <label for="standard_rate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Standard Rack Rate</label>
                            <input type="text" name="standard_rate" v-model="form.standard_rate" id="standard_rate"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="KES 10000/day" required="">
                            <p v-if="contractStore.errors.standard_rate"
                               class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                class="font-medium">{{ contractStore.errors.standard_rate[0] }}</span></p>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea id="description" name="description" v-model="form.description" rows="5"
                                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                      placeholder="Your description here"></textarea>
                            <p v-if="contractStore.errors.description"
                               class="mt-2 text-xs text-red-600 dark:text-red-400"><span
                                class="font-medium">{{ contractStore.errors.description[0] }}</span></p>

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
