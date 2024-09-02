<template>

    <div class="col-sm-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="avatar-xs me-3">
                                                        <span
                                                            class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-18">
                                                            <i :class="Icon"></i>
                                                        </span>
                    </div>
                    <h5 class="font-size-14 mb-0">{{ Title }}</h5>
                </div>
                <div class="text-muted mt-4">
                    <h4 class="d-flex  flex-wrap flex-column">
                        <p v-for="(currency, index) in Currencies" class="m-0 text-success" >
                           <span>{{ counterStore.formatNumber(currency.total_cost.toFixed(2)) }}</span> {{currency.sign}} </p>
                    </h4>
                    <div class="d-flex flex-wrap">
                         <span class="mr-3 text-truncate text-wrap">{{Text}} &nbsp;</span>
                        <span class="badge badge-soft-success font-size-12"> {{Share}} </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {useConterStore} from "@/store/counter.js";
export default {
    props: {
        Title: {
            type: [String, Number],
            default: 'Title'
        },
        Currencies: {
            type: [Array, Object],
            default: [
                {
                    total_amount: 1000,
                    sign: '$',
                },
            ]
        },
        Text: {
            type: [String, Number],
            default: "Block desc or text"
        },
        Share: {
            type: [String, Number],
            default: '+0.2%'
        },
        Number: {
            type: [String, Number],
            default: '1,200'
        },
        Icon: {
            type: String,
            default: 'bx bx-copy-alt'
        },

    },
    setup(){
        const counterStore = useConterStore();
        return{counterStore}
    },
}
</script>
