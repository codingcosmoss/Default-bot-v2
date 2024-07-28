<template>
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">

                        <thead>
                        <tr>

                            <th>{{ $t('Id') }}</th>
                            <th>{{ $t('Warehouse') }}</th>
                            <th>{{ $t('Supplier') }}</th>
                            <th>{{ $t('ImportedDate') }}</th>
                            <th>{{ $t('Subtotal') }}</th>
                            <th>{{ $t('AmountPaid') }}</th>
                            <th>{{ $t('Indebtedness') }}</th>
                            <th>{{ $t('Status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="document.length != 0">
                            <td>
                                #{{ document.id }}
                            </td>
                            <td>{{ document.warehouse.name }}</td>
                            <td>{{ document.supplier.name }}</td>
                            <td>{{ document.date }}</td>
                            <td>{{ counterStore.formatNumber(document.subtotal)}} {{document.currency.sign}} </td>
                            <td>{{ counterStore.formatNumber(document.amount_paid)}} {{document.currency.sign}} </td>
                            <td>{{ counterStore.formatNumber(document.loan_amount)}} {{document.currency.sign}} </td>
                            <td>
                            <span :class="document.status == 5 ? 'badge-soft-success' : 'badge-soft-warning' "
                                  class="badge badge-pill  font-size-11">{{ document.status  == 5 ? $t('Saved') : $t('NotSaved') }}</span>

                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
import {documentShow} from "@/helpers/api.js";
import {ApiError} from "@/helpers/Config.js";
import {useConterStore} from "@/store/counter.js";
export default
{
    setup(){
        const counterStore = useConterStore();
        return{counterStore}
    },
    props:{
        document:{
            type: [Array, Object],
            default: []
        }
    },

}
</script>
