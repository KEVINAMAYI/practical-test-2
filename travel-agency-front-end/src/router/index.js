import {createRouter, createWebHistory} from 'vue-router'
import LoginView from '../views/LoginView.vue'


const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'login',
            component: LoginView,
            meta: {requiresAuth: false},

        },
        {
            path: '/login',
            name: 'login',
            component: () => import('../views/LoginView.vue'),
            meta: {requiresAuth: false},

        },
        {
            path: '/logout',
            name: 'logout',
            component: () => import('../views/LogoutView.vue'),
            meta: {requiresAuth: true},
        },
        {
            path: '/travel-agents',
            name: 'travel-agents',
            component: () => import('../views/TravelAgentsView.vue'),
            meta: {requiresAuth: true},

        },
        {
            path: '/create/travel-agents',
            name: 'create-travel-agents',
            component: () => import('../views/CreateTravelAgentView.vue'),
            meta: {requiresAuth: true},

        },
        {
            path: '/edit/:travelAgentID/travel-agent',
            name: 'edit-travel-agent',
            component: () => import('../views/EditTravelAgentView.vue'),
            props:true,
            meta: {requiresAuth: true},
        },
        {
            path: '/accommodations',
            name: 'accommodations',
            component: () => import('../views/AccommodationsView.vue'),
            meta: {requiresAuth: true},

        },
        {
            path: '/create/accommodation',
            name: 'create-accommodation',
            component: () => import('../views/CreateAccommodationView.vue'),
            meta: {requiresAuth: true},

        },
        {
            path: '/edit/:accommodationID/accommodation',
            name: 'edit-accommodation',
            component: () => import('../views/EditAccommodation.vue'),
            props:true,
            meta: {requiresAuth: true},

        },
        {
            path: '/contracts',
            name: 'contracts',
            component: () => import('../views/ContractsView.vue'),
            meta: {requiresAuth: true},

        },
        {
            path: '/create/contract',
            name: 'create-contract',
            component: () => import('../views/CreateContractView.vue'),
            meta: {requiresAuth: true},

        },
        {
            path: '/edit/:contractID/contract',
            name: 'edit-contract',
            component: () => import('../views/EditContractView.vue'),
            props : true,
            meta: {requiresAuth: true},

        },
        {
            path: '/bookings',
            name: 'bookings',
            component: () => import('../views/BookingsView.vue'),
            meta: {requiresAuth: true},

        },
        {
            path: '/create/booking',
            name: 'create-booking',
            component: () => import('../views/CreateBookingView.vue'),
            meta: {requiresAuth: true},

        },
        {
            path: '/edit/:bookingID/booking',
            name: 'edit-booking',
            component: () => import('../views/EditBookingView.vue'),
            props:true,
            meta: {requiresAuth: true},

        },
    ]
})


export default router
