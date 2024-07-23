<template>
   <div class=" w-100 d-flex justify-content-end">
       <div class="col-xl-5">
           <div class="card">
               <div class="card-body">
                   <div class="table-responsive">
                       <table class="table table-nowrap mb-0">
                           <tbody>
                           <tr>
                               <th scope="row">{{$t('Subtotal')}} :</th>
                               <td>{{counterStore.formatNumber(subtotal)}} {{counterStore.user.currency.sign}}</td>
                           </tr>
                           <tr>
                               <th scope="row">{{$t('AmountToPaid')}} :</th>
                               <td>{{counterStore.formatNumber(subtotal)}} {{counterStore.user.currency.sign}}</td>
                           </tr>
                           <tr>
                               <th scope="row">{{$t('Paid')}} :</th>
                               <td>

                                   <DefaultIconInput
                                       DefaultIconInput
                                       Label=""
                                       Name="warehouse_id"
                                       Type="text"
                                       :Validated="errors"
                                       @onInput="addPrice($event)"
                                       inputClass="reportPrice"
                                       :Value="counterStore.formatNumber(paid)"
                                   >
                                       {{counterStore.user.currency.sign}}
                                   </DefaultIconInput>
                               </td>
                           </tr>
                           <tr>
                               <th scope="row">{{$t('PaymentType')}} :</th>
                               <td>
                                   <DefaultSelect
                                       Label=""
                                       Name="payment_type_id"
                                       :Validated="errors"
                                       :Value="payment_type_id"
                                       @onInput="payment_type_id = $event,  delete this.errors.payment_type_id"
                                   >
                                       <option selected>---</option>
                                       <option v-for="paymentType in paymentTypes" :value="paymentType.id" >{{paymentType.name}}</option>
                                   </DefaultSelect>
                               </td>
                           </tr>


                           </tbody>

                       </table>

                   </div>
                   <br>
                   <BtnBox>
                       <PrimaryBtn>{{ $t('Save') }}</PrimaryBtn>
                   </BtnBox>
               </div>
           </div>
           <!-- end card -->
       </div>
   </div>
</template>
<script>
import {useConterStore} from "@/store/counter.js";
import BtnBox from "@/components/all/BtnBox.vue";
import PrimaryBtn from "@/components/all/PrimaryBtn.vue";
import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
import DefaultIconInput from "@/components/all/DefaultIconInput.vue";
import DefaultSelect from "@/ui-components/Forms/DefaultSelect.vue";
import {payment_types} from "@/helpers/api.js";
import {ApiError} from "@/helpers/Config.js";
export default
{
    components: {DefaultSelect, DefaultIconInput, DefaultInput, PrimaryBtn, BtnBox},
    setup(){
        const counterStore = useConterStore();
        return{counterStore}
    },
    props:{
        medicines: [Object, Array],
        isChange: Boolean
    },
    data(){return{
      subtotal: 0,
      errors: [],
      loader: false,
        paid: 0,
        paymentTypes:[],
        payment_type_id: null

    }},
    methods:{
        report(){
            let subtotal = 0;
            this.medicines.forEach(medicine => {
                subtotal += medicine.buy_price * medicine.buy_amount
            })
            this.subtotal = subtotal;
        },
        addPrice(price){
            let amount = this.counterStore.inputNumberFormat('reportPrice', this.paid, price);
            this.paid = amount;
        },
        async indexPaymentTypes(){
            try {
                this.loader = true;
                const response = await payment_types();
                this.paymentTypes = response.data;
                this.loader = false;
            }catch(error){
                ApiError(this, error);
            }
        },
    },
    watch: {
        isChange: function(newVal, oldVal) { // watch it
            this.report()
        }
    },
    mounted() {
        this.indexPaymentTypes()
    }

}
</script>
