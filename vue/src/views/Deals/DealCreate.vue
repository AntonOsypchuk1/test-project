<script setup>

import {ref} from 'vue'
import PageContent from "../../components/PageContent.vue";
import store from "../../store/index.js";
import {useRouter} from "vue-router";

const router = useRouter();
const deal = {
    dealName: '',
    dealStage: '',
    account: ''
}
const errorMsg = ref('')

function createDeal(ev) {
    ev.preventDefault();

    store.dispatch('saveDeal', deal)
        .then(() => {
            router.push({
                name: 'Dashboard'
            })
        })
        .catch(err => {
            errorMsg.value = err.response.data.error;
        })
}

</script>

<template>
    <PageContent title="Create a New Deal">
        <div class="grid grid-cols-7">
            <form @click="createDeal" class="col-5 m-auto">
                <div class="col-sm-6">
                    <label for="dealName" class="form-label">Deal Name</label>
                    <input v-model="deal.dealName" type="text" class="form-control" id="dealName">
                    <div v-if="errorMsg" class="invalid-feedback">
                        Valid deal name is required.
                    </div>
                </div>

                <div class="col-sm-6">
                    <label for="dealStage" class="form-label">Deal Stage</label>
                    <input v-model="deal.dealStage" type="text" class="form-control" id="dealStage">
                    <div v-if="errorMsg" class="invalid-feedback">
                        Valid deal stage is required.
                    </div>
                </div>

                <div class="col-12">
                    <label for="accountName" class="form-label">Account</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text">@</span>
                        <input v-model="deal.account" type="text" class="form-control" id="accountName"
                               placeholder="Account Name">
                        <div v-if="errorMsg" class="invalid-feedback">
                            Your account is required.
                        </div>
                    </div>
                </div>
                <button class="mt-4 w-100 btn btn-primary btn-lg text-center" type="submit">
                    Create
                </button>
            </form>
        </div>
    </PageContent>
</template>

<style scoped>

</style>
