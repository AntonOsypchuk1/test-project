<script>
import {computed, defineComponent} from 'vue'
import {useStore} from "vuex";
import {useRouter} from "vue-router";

const navigation = [
    {name: "Dashboard", to: {name: 'Dashboard'}},
]

export default defineComponent({
    name: "DefaultLayout",
    setup() {
        const store = useStore();
        const router = useRouter();

        function logout() {
            store.dispatch('logout')
                .then(() => {
                    router.push({
                        name: 'Login'
                    });
                });
        }

        return {
            user: computed(() => store.state.user),
            navigation,
            logout
        }
    }
})
</script>

<template>
    <div class="container">
        <header class="d-flex flex-wrap space align-items-center justify-content-between py-3 mb-4 border-bottom">
            <div>
                <router-link
                    v-for="item in navigation"
                    :key="item.name"
                    :to="item.to"
                    active-class="nav-link px-2 link-secondary"
                    :class="[
                            this.$route.name === item.to.name
                                ? ''
                                : 'nav-link px-2'
                        ]"
                >{{ item.name }}
                </router-link>
            </div>

            <div class="d-inline-flex col-md-4 justify-content-end">
                <div v-if="user.data.name" class="block text-center p-2 px-4">
                    <p style="font-weight: bold; font-size: 16px">
                        Welcome, {{user.data.name}}!
                    </p>
                </div>
                <div>
                    <button
                        @click="logout"
                        class="btn btn-outline-secondary px-3 py-2 rounded-md text-base font-medium"
                    >Sign out
                    </button>
                </div>
            </div>
        </header>
    </div>
    <div class="container">
        <router-view></router-view>
    </div>
</template>

<style scoped>

</style>
