import {defineStore} from "pinia";
import axios from "axios";
import {useAuthStore} from './Authstore';


export const useContractStore = defineStore("contract", {
    state: () => ({
        errors: {},
        contract: {},
        contracts: [],
        isLoading: false,
        success: {},
    }),
    getters: {},
    actions: {
        async getContracts() {
            try {
                this.isLoading = true;
                await axios.get('/contracts', {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.contracts = res.data
                    this.isLoading = false;
                    this.scrollUp();
                });
            } catch (error) {
                console.log(error);
                this.isLoading = false;
                if (error.response.status === 422) {
                    this.scrollUp();
                    this.errors = error.response.data.errors
                    this.clearAlert();
                }
            }
        },
        async getContract(data) {
            try {
                this.isLoading = true;
                await axios.get(`/contracts/${data}`, {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.contract = res.data
                    console.log(res.data);
                    this.isLoading = false;
                    this.scrollUp();
                });
            } catch (error) {
                console.log(error);
                this.isLoading = false;
                if (error.response.status === 422) {
                    this.scrollUp();
                    this.errors = error.response.data.errors
                    this.clearAlert();
                }
            }
        },
        async addContract(data) {
            try {
                this.isLoading = true;
                await axios.post('/contracts', data, {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.isLoading = false;
                    this.scrollUp();
                    this.success = {message: 'Contract created successfully'}
                    this.clearAlert();
                    // router.push({name: "travel-agents"})
                });
            } catch (error) {
                console.log(error);
                this.isLoading = false;
                if (error.response.status === 422) {
                    this.scrollUp();
                    this.errors = error.response.data.errors
                    this.clearAlert();
                }
            }
        },
        async updateContract() {
            console.log()
            try {
                this.isLoading = true;
                await axios.put(`/contracts/${this.contract.id}`, {
                    contract_number: this.contract.contract_number,
                    travel_agent_id: this.contract.travel_agent_id,
                    exclusive: this.contract.exclusive,
                    start_date: this.contract.start_date,
                    end_date: this.contract.end_date,
                    standard_rate: this.contract.standard_rate,
                    description: this.contract.description
                }, {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.isLoading = false;
                    this.scrollUp();
                    this.success = {message: 'Contract updated successfully'}
                    this.clearAlert();
                    // router.push({name: "travel-agents"})
                });
            } catch (error) {
                console.log(error);
                this.isLoading = false;
                if (error.response.status === 422) {
                    this.scrollUp();
                    this.errors = error.response.data.errors
                    this.clearAlert();
                }
            }
        },
        async deleteContract(data) {
            try {

                if (!window.confirm('This item will be deleted !')) {
                    return
                }

                this.isLoading = true;
                await axios.delete(`/contracts/${data}`, {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.isLoading = false;
                    this.scrollUp();
                    this.clearAlert();
                    this.getContracts()
                });
            } catch (error) {
                console.log(error);
                this.isLoading = false;
                if (error.response.status === 422) {
                    this.scrollUp();
                    this.errors = error.response.data.errors
                    this.clearAlert();
                }

            }
        },
        async searchContracts(data) {
            try {
                this.isLoading = true;
                await axios.get('/contracts/search', {headers: {Authorization: `Bearer ${this.getToken()}`},params:{search : data}}).then((res) => {
                    console.log(res.data);
                    this.contracts = res.data
                    this.isLoading = false;
                    this.scrollUp();
                });
            } catch (error) {
                console.log(error);
                this.isLoading = false;
                if (error.response.status === 422) {
                    this.scrollUp();
                    this.errors = error.response.data.errors
                    this.clearAlert();
                }
            }
        },
        clearAlert() {
            setTimeout(() => this.errors = {}, 5000);
            setTimeout(() => this.success = {}, 5000);
        },
        scrollUp() {
            window.scrollTo(0, 0);
        },
        getToken() {
            const authStore = useAuthStore();
            return authStore.userToken
        }
    },
    persist: {
        enabled: true
    }
});
