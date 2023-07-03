<script setup>
import {defineComponent} from 'vue'
import PageContent from "../../components/PageContent.vue";
import store from "../../store/index.js";

const props = defineProps({
    deal: Object
})

function editDeal(deal) {
    if (
        confirm(
            `Are you sure you want to edit this deal? Operation can't be undone!!`
        )
    ) {
        store.dispatch("editDeal", deal).then(() => {
            store.dispatch("getDeals");
        });
    }
}
</script>

<template>
    <PageContent title="Edit the deal ''">
        <div class="grid grid-cols-7">
            <form @click="editDeal">
                <div class="col-5 m-auto">
                    <div class="col-sm-6">
                        <label for="dealName" class="form-label">Deal Name</label>
                        <input type="text" class="form-control" id="dealName" placeholder="" value="{{deal['Deal_Name']}}" required="">
                        <div class="invalid-feedback">
                            Valid deal name is required.
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="dealStage" class="form-label">Deal Stage</label>
                        <input type="text" class="form-control" id="dealStage" placeholder="" value="{{deal['Deal_Stage']}}" required="">
                        <div class="invalid-feedback">
                            Valid deal stage is required.
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="accountName" class="form-label">Account</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">@</span>
                            <input type="text" class="form-control" id="accountName" placeholder="Account Name" value="{{deal['Account_Name']}}" required="">
                            <div class="invalid-feedback">
                                Your username is required.
                            </div>
                        </div>
                    </div>

                    <button class="mt-4 w-100 btn btn-primary btn-lg text-center" type="submit">
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </PageContent>
</template>

<style scoped>

</style>
