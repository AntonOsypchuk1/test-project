<script setup>

import store from "../store/index.js";
import {useRouter} from "vue-router";
import {ref} from "vue";

const router = useRouter();
const user = {
    email: '',
    password: '',
    remember: false
}
let errorMsg = ref('');

function login(ev) {
    ev.preventDefault();

    store.dispatch('login', user)
        .then(() => {
            router.push({
                name: 'Dashboard'
            })
        })
        .catch(err => {
            errorMsg.value = err.response.data.error
        })
}

</script>

<template>
    <div class="container align-items-center form-signin w-50 mt-5 py-5 ">
        <form @submit="login">
            <div class="d-flex inline-flex justify-content-between align-items-center">
                <h1 class="h3 mb-3 fw-normal text-start">Please sign in</h1>

                <div v-if="errorMsg" class="text-danger text-end">
                    {{errorMsg}}
                </div>
            </div>

            <div class="form-floating">
                <input v-model="user.email" type="email" class="form-control rounded-bottom-0" id="email" placeholder="name@example.com">
                <label for="email">Email address</label>
            </div>
            <div class="form-floating">
                <input v-model="user.password" type="password" class="form-control rounded-top-0 border-top-0" id="password" placeholder="Password">
                <label for="password">Password</label>
            </div>

            <div class="form-check text-start my-3">
                <input v-model="user.remember" class="form-check-input" type="checkbox" value="remember" id="remember">
                <label class="form-check-label" for="remember">
                    Remember me
                </label>
            </div>

            <button class=" mt-4 btn btn-primary w-100 py-2" type="submit">Sign in</button>
            <router-link :to="{name: 'Register'}" class="link-primary">
                Register a new account
            </router-link>
            <p class="mt-5 mb-3 text-body-secondary">© 2017–2023</p>
        </form>
    </div>
</template>

<style scoped>

</style>
