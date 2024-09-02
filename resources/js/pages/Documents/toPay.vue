<template>
    <!--    Modal   -->
    <ModalCentered :Title="$t('ToPay')" ModalName="documentToPayModal" @onModal="toPay()">
        <div class="row"  >
            <BaseBox Col="col-xl-12" Title="">
                <DefaultIconInput
                    DefaultIconInput
                    :Label="$t('Amount')"
                    Name="amount"
                    Type="text"
                    :Validated="errors"
                    @onInput="addPrice($event),  delete this.errors.amount"
                    inputClass="reportPrice"
                    :Value="counterStore.formatNumber(paid)"
                >
                    {{sign}}
                </DefaultIconInput>
                <p  class="form-label text-danger"></p>
                <DefaultSelect
                    :Label="$t('PaymentType')"
                    Name="payment_type_id"
                    :Validated="errors"
                    :Value="payment_type_id"
                    @onInput="payment_type_id = $event,  delete this.errors.payment_type_id"
                >
                    <option selected >---</option>
                    <option v-for="paymentType in paymentTypes" :value="paymentType.id" >{{paymentType.name}}</option>
                </DefaultSelect>
            </BaseBox>

        </div>
    </ModalCentered>
</template>
<script>
import Page from "@/components/layout/Page.vue";
import {ApiError} from "@/helpers/Config.js";
import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
import PrimaryButton from "@/components/all/PrimaryButton.vue";
import {Alert} from "@/helpers/Config.js";
import ImageInput from "@/components/all/ImageInput.vue";
import {useConterStore} from "@/store/counter.js";
import ModalCentered from "@/components/all/ModalCentered.vue";
import BtnBox from "@/components/all/BtnBox.vue";
import PrimaryBtn from "@/components/all/PrimaryBtn.vue";
import DefaultSelect from "@/ui-components/Forms/DefaultSelect.vue";
import DefaultIconInput from "@/components/all/DefaultIconInput.vue";
import {document_paymentCreate} from "@/helpers/api.js";

export default {
    components: {
        DefaultIconInput,
        DefaultSelect, PrimaryBtn, BtnBox, ModalCentered, ImageInput, PrimaryButton, DefaultInput, Page},
    setup() {
        const counterStore = useConterStore();
        return {counterStore}
    },
    props:{
        Item: Object,
        paymentTypes:{
            type: [Object, Array],
            default: []
        }
    },
    data() {
        return {
            items: [],
            item: [],
            paginateCount: 10,
            column: 'id',
            type: 'desc',
            errors: [],
            passwordErrors: [],
            loader: false,
            loaderPass: false,
            // forms
            payment_type_id: null,
            document_id: null,
            currency_id: null,
            paid: 0,
            sign: '',
            //
        }
    },
    methods: {
        async toPay(){
            try {
                this.loader = true;
                if (!this.vatidator()){
                    this.loader = false;
                    return;
                }

                let data = {
                    payment_type_id: this.payment_type_id,
                    amount: this.paid,
                    supplier_id: this.Item.supplier_id,
                    document_id: this.document_id,
                    currency_id: this.currency_id,
                }
                console.log('Data:', data);
                const response = await document_paymentCreate(data);
                if (response.status){
                    this.$emit('onPayment', true);
                    this.counterStore.hiddenModal('documentToPayModal');
                    this.discharge();
                    Alert('success', this.$t('save'));
                    this.loader = false;
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
        vatidator(){
            if (this.paid == 0){
                this.errors['amount'] = this.$t('EnterPaymentAmount');
                Alert('error', this.$t('EnterPaymentAmount'))
                return false;
            }else if (this.paid > this.Item.loan_amount){
                this.errors['amount'] = this.$t('TheIncreased');
                Alert('error', this.$t('TheIncreased'))
                return false;
            }
            this.errors['amount'] ="";
            return true;
        },
        async save() {
            this.sign = this.Item.currency.sign
            this.currency_id = this.Item.currency.id
            this.item = this.Item;
            this.document_id = this.Item.id;
        },
        discharge() {
            this.item = '';
            this.document_id = null;
            this.currency_id = null;
            this.paid = 0;
            this.errors = [];
        },
        addPrice(price){
            let amount = this.counterStore.inputNumberFormat('reportPrice', this.paid, price);
            this.paid = amount;
        },
    },
    mounted() {
        this.discharge()
    },
    watch: {
        Item: function(newVal, oldVal) { // watch it
            this.save()
        }
    }
}
</script>
<style></style>
