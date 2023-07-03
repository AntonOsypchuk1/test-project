<script setup>

import PageContent from "../components/PageContent.vue";
import { PencilIcon, ExternalLinkIcon, TrashIcon } from '@heroicons/vue/solid'

import store from "../store/index.js";
import {computed} from "vue";
import {useRouter} from "vue-router";

store.dispatch("getDashboardContent");
const deals = computed(() => store.state.deals.data);
const accounts = computed(() => store.state.accounts.data);
const router = useRouter();

function createDeal(ev) {
    ev.preventDefault()

    router.push({
        name: 'DealsCreate'
    })
}

function editDeal(ev) {
    ev.preventDefault()

    router.push({
        name: 'DealsEdit'
    });
}

function deleteDeal(deal) {
    if (
        confirm(
            `Are you sure you want to delete this deal? Operation can't be undone!!`
        )
    ) {
        store.dispatch("deleteDeal", deal).then(() => {
            store.dispatch("getDeals");
        });
    }
}

function createAccount(ev) {
    ev.preventDefault()

    router.push({
        name: 'AccountsCreate'
    })
}

function editAccount(ev) {
    ev.preventDefault()

    router.push({
        name: 'AccountsEdit'
    });
}

function deleteAccount(account) {
    if (
        confirm(
            `Are you sure you want to delete this account? Operation can't be undone!!`
        )
    ) {
        store.dispatch("deleteAccount", account['id']).then(() => {
            store.dispatch("getAccounts");
        });
    }
}

</script>

<template>
    <PageContent title="Dashboard">
<!--        Deals-->
        <div class="table-responsive">
            <div class="block w-100 d-flex flex-row justify-content-between">
                <h1 class="h3">Deals</h1>
                <button @click="createDeal" class="btn btn-outline-primary">
                    Create Deal
                </button>
            </div>
            <div class="block" style="height: 500px">
                <table class="table table-striped table overflow-auto">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Deal Name</th>
                        <th scope="col">Deal Stage</th>
                        <th scope="col">Account Name</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                        v-if="deals"
                        v-for="(deal, i) in deals.data"
                        :key="deal.id"
                    >
                        <td>
                            {{ i+1 }}
                        </td>
                        <td>
                            {{deal['Deal_Name']}}
                        </td>
                        <td>
                            {{deal['Stage']}}
                        </td>
                        <td>
                            {{deal['Account_Name']}}
                        </td>
                        <td>
                            <form @click="editDeal">
                                <button type="submit" class="btn btn-outline-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form @click="deleteDeal">
                                <button type="submit" class="btn btn-outline-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr v-else>
                        <td colspan="10">
                            <p class="text text-center p-2 m-0">You don't have any deals yet</p>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>

<!--        Accounts-->
        <div class="table-responsive mt-5">
            <div class="block w-100 d-flex flex-row justify-content-between">
                <h1 class="h3">Accounts</h1>
                <button @click="createAccount" class="btn btn-outline-primary">
                    Create Account
                </button>
            </div>
            <div class="block" style="height: 500px">
                <table class="table table-striped table overflow-auto">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Account Name</th>
                        <th scope="col">Website</th>
                        <th scope="col">Phone</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                        v-if="accounts"
                        v-for="(account, i) in accounts.data"
                        :key="account.id"
                    >
                        <td>
                            {{ i+1 }}
                        </td>
                        <td>
                            {{account['Account_Name']}}
                        </td>
                        <td>
                            {{account['Website']}}
                        </td>
                        <td>
                            {{account['Phone']}}
                        </td>
                        <td>
                            <form @click="editAccount">
                                <button type="submit" class="btn btn-outline-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form @click="deleteAccount">
                                <button type="submit" class="btn btn-outline-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <tr v-else>
                        <td colspan="10">
                            <p class="text text-center p-2 m-0">You don't have any accounts yet</p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </PageContent>
</template>

<style scoped>

</style>
