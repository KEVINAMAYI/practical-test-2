import {defineStore} from "pinia";
import axios from "axios";
import {useAuthStore} from './Authstore';


export const useAccommodationStore = defineStore("accommodation", {
    state: () => ({
        errors: {},
        accommodation : {},
        accommodations : [],
        isLoading: false,
        success: {},
    }),
    getters: {},
    actions: {
        async getAccomodations() {
            try {
                this.isLoading = true;
                await axios.get('/accommodations', {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.accommodations = res.data
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
        async getAccomodation(data) {
            try {
                this.isLoading = true;
                await axios.get(`/accommodations/${data}`, {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.accommodation = res.data
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
        async addAccommodation(data) {
            try {
                this.isLoading = true;
                await axios.post('/accommodations', data, {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.isLoading = false;
                    this.scrollUp();
                    this.success = {message: 'Accommodation created successfully'}
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
        async updateAccommodation() {
            try {
                this.isLoading = true;
                await axios.put(`/accommodations/${this.accommodation.id}`, this.accommodation, {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.isLoading = false;
                    this.scrollUp();
                    this.success = {message: 'Accommodation updated successfully'}
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
        async deleteAccommodation(data) {
            try {

                if (!window.confirm('This item will be deleted !')) {
                    return
                }

                this.isLoading = true;
                await axios.delete(`/accommodations/${data}`, {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.isLoading = false;
                    this.scrollUp();
                    this.clearAlert();
                    this.getAccomodations()
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
        scrollUp(){
            window.scrollTo(0, 0);
        },
        getToken(){
            const authStore = useAuthStore();
            return authStore.userToken
        }
    },
    persist: {
        enabled: true
    }
});
