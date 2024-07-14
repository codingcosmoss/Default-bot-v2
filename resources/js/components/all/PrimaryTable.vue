
<template>

    <div class="table-responsive">
        <table class="table table-bordered border-primary mb-0">

            <thead>
            <tr>
                <th v-for="th in Th" class="align-middle">{{th}}</th>
            </tr>
            </thead>
            <tbody>
                <slot></slot>
            </tbody>
        </table>
    </div>

</template>

<script>
import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
import BtnBox from "@/components/all/BtnBox.vue";
import PrimaryBtn from "@/components/all/PrimaryBtn.vue";

export default {
    components: {PrimaryBtn, BtnBox, DefaultInput},
    props:{
        Col: {
            type: [String, Number],
            default: 'col-lg-12'
        },
        Title: {
            type: [String, Number],
            default: 'Latest Transaction'
        },
        Modal: {
            type: [String, Number],
            default: 'Modal'
        },
        BtnTitle: {
            type: [String, Number],
            default: 'Create'
        },
        Th: {
            type: [Array, Object],
            default: ['Order ID', 'Billing Name', 'Date', 'Total', 'Payment Status']
        },
    }
}

</script>
