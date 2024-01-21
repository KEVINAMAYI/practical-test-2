import {defineStore} from "pinia";
import axios from "axios";
import router from "../router";


export const useAuthStore = defineStore("auth", {
    state: () => ({
        errors: {},
        user: null,
        token: null,
        isLoading: false,
        success: {}
    }),
    getters: {
        userToken: (state) => state.token,
        loggedInUser: (state) => state.user,
    },
    actions: {
        async login(data) {
            try {
                this.isLoading = true;
                await axios.post('/login', data).then((res) => {
                    this.isLoading = false;
                    this.scrollUp();
                    this.token = res.data.accessToken;
                    this.user = res.data.user;
                    console.log(res.data.user)
                    router.push({name: "bookings"})
                });
            } catch (error) {
               console.log(error);
                this.isLoading = false;
                if (error.response.status === 422) {
                    this.scrollUp();
                    this.errors = error.response.data.errors
                    this.clearAlert();
                }
                if (error.response.status === 401) {
                    this.errors.error = error.response.data.error
                    this.clearAlert();

                }
            }
        },
        async logout(token) {
            await axios.get('/logout', {headers: {Authorization: `Bearer ${token}`}}).then((res) => {
                this.token = null;
                this.user = null;
                router.push({name: "login"})
            });
        },
        clearAlert() {
            setTimeout(() => this.errors = {}, 5000);
            setTimeout(() => this.success = {}, 5000);
        },
        scrollUp(){
            window.scrollTo(0, 0);
        }
    },
    persist: {
        enabled: true
    }
});
