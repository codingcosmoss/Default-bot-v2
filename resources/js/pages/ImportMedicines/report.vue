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
                                       Name="amount_paid"
                                       Type="text"
                                       :Validated="errors"
                                       @onInput="addPrice($event),  delete this.errors.amount_paid"
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
                                       <option selected :value="0" >---</option>
                                       <option v-for="paymentType in paymentTypes" :value="paymentType.id" >{{paymentType.name}}</option>
                                   </DefaultSelect>
                               </td>
                           </tr>


                           </tbody>

                       </table>

                   </div>
                   <br>
                   <BtnBox>
                       <PrimaryBtn :Loader="loader" @click="save()">{{ $t('Save') }}</PrimaryBtn>
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
import {imported_medicineCreate, payment_types} from "@/helpers/api.js";
import {ApiError} from "@/helpers/Config.js";
import {Alert} from "@/helpers/Config.js";

export default
{
    components: {DefaultSelect, DefaultIconInput, DefaultInput, PrimaryBtn, BtnBox},
    setup(){
        const counterStore = useConterStore();
        return{counterStore}
    },
    props:{
        medicines: [Object, Array],
        document: [Object, Array],
        isChange: Boolean
    },
    data(){return{
      subtotal: 0,
      errors: [],
      loader: false,
        paid: 0,
        paymentTypes:[],
        payment_type_id: null,
        dataErrors:[],
    }},
    methods:{
        validator(){
            let dataErrors = [];
            this.medicines.forEach((medicine, index) => {
                if (medicine.expiry_date_finished == null || this.isDateBeforeToday(medicine.expiry_date_finished))
                {
                    dataErrors.push('date'+medicine.sortId);
                }
                if (!this.isNumber(medicine.buy_price))
                {
                    dataErrors.push('buy_price'+medicine.sortId);
                }
                if (!this.isNumber(medicine.buy_amount) || medicine.buy_amount <= 0)
                {
                    dataErrors.push('buy_amount'+medicine.sortId);
                }
            })
            this.dataErrors = dataErrors;
            if (dataErrors.length > 0 || this.medicines == []){
                Alert('error', this.$t('formError'))
                return false;
            }else if(this.paid > this.subtotal){
                Alert('error', this.$t('TheIncreased'))
                return false;
            }else if(this.paid > 0 && this.payment_type_id < 1){
                Alert('error', this.$t('PaymentTyperequired'))
                return false;
            }
            return true;
        },
        isNumber(value) {
            // Agar value string bo'lsa, raqamga aylantirishga harakat qilish
            const number = parseFloat(value);
            // NaN yoki typeof tekshirish orqali raqam ekanligini aniqlash
            return !isNaN(number) && typeof number === 'number';
        },
        isDateBeforeToday(dateString) {
            // Parametr sifatida kelgan sana satrini Date obyektiga o'girib oling
            const inputDate = new Date(dateString);

            // Hozirgi sanani Date obyektiga o'girib oling
            const today = new Date();

            // Hozirgi sananing vaqtini nolga qaytarib oling (faqat sanani hisobga olish uchun)
            today.setHours(0, 0, 0, 0);

            // Input sanani vaqtini ham nolga qaytarib oling (faqat sanani hisobga olish uchun)
            inputDate.setHours(0, 0, 0, 0);

            // Input sanani hozirgi sanadan oldin yoki yo'qligini tekshiring
            return inputDate < today;
        },
        async save(){
            try {
                this.loader = true;
                if (!this.validator()){
                    this.$emit('dataErrors', this.dataErrors);
                    this.loader = false;
                    return false;
                }

                let data = {
                    document_id: this.document.id,
                    supplier_id: this.document.supplier_id,
                    warehouse_id: this.document.warehouse_id,
                    payment_type_id: this.payment_type_id,
                    amount_paid: this.paid,
                    medicines: this.medicines,
                    currency_id: this.counterStore.user.currency.id,
                }
                console.log('Data:', data);
                const response = await imported_medicineCreate(data);
                if (response.status){
                    Alert('success', this.$t('save'));
                    this.loader = false;
                    this.$router.push('/admin/documents');
                    return true;
                }
                this.errors = response.errors;
                Alert('error', this.$t('formError'));
                this.loader = false;
                return false;
            }catch(error){
                ApiError(this, error);
                this.loader = false;
                return false;
            }
        },
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
