import {createRouter, createWebHistory} from "vue-router";
import Dashboard from "../views/Dashboard.vue";
import DefaultLayout from "../components/DefaultLayout.vue";
import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import AuthLayout from "../components/AuthLayout.vue";
import store from "../store/index.js";
import AccountCreate from "../views/Accounts/AccountCreate.vue";
import DealCreate from "../views/Deals/DealCreate.vue";
import DealEdit from "../views/Deals/DealEdit.vue";
import AccountEdit from "../views/Accounts/AccountEdit.vue";

const routes = [
    {
        path: "/",
        redirect: "/dashboard",
        component: DefaultLayout,
        meta: { requiresAuth: true },
        children: [
            { path: "/dashboard", name: "Dashboard", component: Dashboard },
            { path: "/deals/create", name: "DealsCreate", component: DealCreate },
            { path: "/deals/update", name: "DealsEdit", component: DealEdit },
            { path: "/accounts/create", name: "AccountsCreate", component: AccountCreate },
            { path: "/accounts/update", name: "AccountsEdit", component: AccountEdit },
            // { path: "/deals/:id", name: "DealsView", component: DealView },
        ]
    },
    {
        path: "/auth",
        redirect: "/login",
        name: "Auth",
        component: AuthLayout,
        meta: {isGuest: true},
        children: [
            {
                path: "/login",
                name: "Login",
                component: Login,
            },
            {
                path: "/register",
                name: "Register",
                component: Register,
            },
        ],
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.token) {
        next({ name: "Login" });
    } else if (store.state.user.token && to.meta.isGuest) {
        next({ name: "Dashboard" });
    } else {
        next();
    }
});

export default router;
