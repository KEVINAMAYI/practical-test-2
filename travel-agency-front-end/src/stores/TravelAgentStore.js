import {defineStore} from "pinia";
import axios from "axios";
import {useAuthStore} from './Authstore';
import router from "../router";


export const useTravelAgentStore = defineStore("travel_agent", {
    state: () => ({
        errors: {},
        travelAgent: {},
        travelAgents: [],
        isLoading: false,
        success: {},
    }),
    getters: {},
    actions: {
        async getTravelAgents() {
            try {
                this.isLoading = true;
                await axios.get('/travel-agents', {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.travelAgents = res.data
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
        async getTravelAgent(data) {
            try {
                this.isLoading = true;
                await axios.get(`/travel-agents/${data}`, {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.travelAgent = res.data
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
        async addTravelAgent(data) {
            try {
                this.isLoading = true;
                await axios.post('/travel-agents', data, {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.isLoading = false;
                    this.scrollUp();
                    this.success = {message: 'Travel agent created successfully'}
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
        async updateTravelAgent() {
            try {
                this.isLoading = true;
                await axios.put(`/travel-agents/${this.travelAgent.id}`, {

                    'first_name': this.travelAgent.user.first_name,
                    'last_name': this.travelAgent.user.last_name,
                    'email': this.travelAgent.user.email,
                    'experience': this.travelAgent.experience,
                    'about_me': this.travelAgent.about_me,

                }, {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.isLoading = false;
                    this.scrollUp();
                    this.success = {message: 'Travel agent updated successfully'}
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
        async deleteTravelAgent(data) {
            try {

                if (!window.confirm('This item will be deleted !')) {
                    return
                }

                this.isLoading = true;
                await axios.delete(`/travel-agents/${data}`, {headers: {Authorization: `Bearer ${this.getToken()}`}}).then((res) => {
                    this.isLoading = false;
                    this.scrollUp();
                    this.clearAlert();
                    this.getTravelAgents()
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
