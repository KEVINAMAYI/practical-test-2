import {defineStore} from "pinia";
import axios from "axios";
import {useAuthStore} from './Authstore';


export const useAccommodationBookingStore = defineStore("accommodation_booking", {
    state: () => ({
        errors: {},
        accommodationBooking: {},
        accommodationBookings: [],
        isLoading: false,
        success: {},
    }),
    getters: {},
    actions: {
        async getAccommodationBookings() {
            try {
                this.isLoading = true;
                await axios.get('/accommodation-allocations', {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.accommodationBookings = res.data
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
        async getAccommodationBooking(data) {
            try {
                this.isLoading = true;
                await axios.get(`/accommodation-allocations/${data}`, {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.accommodationBooking = res.data
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
        async addAccommodationBooking(data) {
            try {
                this.isLoading = true;
                await axios.post('/accommodation-allocations', data, {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.isLoading = false;
                    this.scrollUp();
                    this.success = {message: 'Accommodation Booked successfully'}
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
        async updateAccommodationBooking() {
            try {
                this.isLoading = true;
                await axios.put(`/accommodation-allocations/${this.accommodationBooking.id}`, {
                    contract_id: this.accommodationBooking.contract_id,
                    accommodation_id: this.accommodationBooking.accommodation_id,
                    start_date: this.accommodationBooking.start_date,
                    end_date: this.accommodationBooking.end_date,
                }, {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.isLoading = false;
                    this.scrollUp();
                    this.success = {message: 'Accommodation Booking updated successfully'}
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
        async deleteAccommodationBooking(data) {
            try {

                if (!window.confirm('This item will be deleted !')) {
                    return
                }

                this.isLoading = true;
                await axios.delete(`/accommodation-allocations/${data}`, {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.isLoading = false;
                    this.scrollUp();
                    this.clearAlert();
                    this.getAccommodationBookings()
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
        async searchAccommodationBookings(data) {
            try {
                this.isLoading = true;
                await axios.get('/accommodation-allocations/search', {headers: {Authorization: `Bearer ${this.getToken()}`},params:{ search : data}}).then((res) => {
                    this.accommodationBookings = res.data
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
