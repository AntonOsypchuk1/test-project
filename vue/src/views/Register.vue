<script setup>

import store from "../store/index.js";
import {useRouter} from "vue-router";
import {ref} from "vue";

const router = useRouter();
const user = {
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
};
let errorMsg = ref('');

function register(ev) {
    ev.preventDefault();
    store
        .dispatch('register', user)
        .then((res) => {
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
    <div class="container form-signin w-50 mt-5 py-5">
        <form @submit="register">
            <div class="d-flex inline-flex justify-content-between align-items-center">
                <h1 class="h3 mb-3 fw-normal">Sign up</h1>

                <div v-if="errorMsg" class="text-danger text-end">
                    {{errorMsg}}
                </div>
            </div>

            <div class="form-floating">
                <input v-model="user.name" name="name" type="text" class="form-control rounded-bottom-0" id="name" placeholder="name@example.com">
                <label for="name">Full name</label>
            </div>
            <div class="form-floating">
                <input v-model="user.email" name="email" type="text" class="form-control rounded-top-0 border-top-0" id="email" placeholder="name@example.com">
                <label for="email">Email address</label>
            </div>

            <div class="form-floating mt-3">
                <input v-model="user.password" name="password" type="password" class="form-control rounded-bottom-0 " id="password" placeholder="Password">
                <label for="password">Password</label>
            </div>
            <div class="form-floating">
                <input v-model="user.password_confirmation" name="password_confirmation" type="password" class="form-control rounded-top-0 border-top-0" id="password_confirmation" placeholder="Password Confirm">
                <label for="password_confirmation">Password</label>
            </div>

            <button class=" mt-4 btn btn-primary w-100 py-2" type="submit">Sign up</button>
            <router-link :to="{name: 'Login'}" class="link-primary">
                Login to your account
            </router-link>
            <p class="mt-5 mb-3 text-body-secondary">© 2017–2023</p>
        </form>
    </div>
</template>

<style scoped>

</style>
