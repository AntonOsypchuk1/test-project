<script setup>
const props = defineProps({
    title: String,
})
</script>

<template>
    <header class="col-md-12 ms-sm-auto px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{ this.title }}</h1>
        </div>
        <slot name="header"></slot>
    </header>
    <main>
        <slot></slot>
    </main>
</template>

<style scoped>

</style>
