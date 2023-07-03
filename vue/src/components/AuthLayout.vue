<script>
import {defineComponent} from 'vue'

export default defineComponent({
    name: "AuthLayout"
})
</script>

<template>
    <main class="form-signin w-100 py-5">
        <router-view></router-view>
    </main>
</template>

<style scoped>

</style>
