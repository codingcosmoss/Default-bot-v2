<template>
    <Page :Title="$t('RegistrationImportedDrugs')"
          :Links="[
                    {
                        path: '/admin/documents',
                        name: $t('ImportDocuments'),
                        status: false
                    },
                     {
                        path: '/',
                        name: $t('RegistrationMedicines'),
                        status: true
                    },
                ]">
        <div class="row"  >
            <Header :document="document" />
            <BasicTable
                :Th="[$t('No'),
                    $t('Picture'),
                    $t('ModalName'),
                    $t('ExpiryDateFinished'),
                    $t('BoxSize'),
                    $t('BuyPrice'),
                    $t('PurchasedAmount'),
                    $t('CurrentAmount'),
                    $t('Subtotal'),
                    $t('Settings'),]"
                Title=""
                Col="col-lg-12"
            >
                <tr v-for="(item, index) in medicines" >
                    <td>
                        {{ index + 1 }}
                    </td>
                    <td>
                        <div class="table_image"  :style="'background-image: url('+ item.medicine.image[0].url +')'"></div>
                    </td>
                    <td>
                        <p class="m-0">{{ item.medicine.name }}</p>
                        <p class="font-size-10 m-0">{{ item.medicine.generic_name }}</p>
                    </td>
                    <td>
                        {{item.expiry_date_finished}}
                    </td>
                    <td>
                        {{item.box_size.name}}
                    </td>

                    <td>
                        {{counterStore.formatNumber(item.buy_price)}} {{item.currency.sign}}
                    </td>
                    <td>{{counterStore.formatNumber(item.amount)}}</td>
                    <td>{{counterStore.formatNumber(item.current_amount)}}</td>
                    <td>{{ counterStore.formatNumber(item.total_cost)}} {{item.currency.sign}}</td>
                    <td>
                        <PrimaryIconBtn
                            v-if="item.amount != 0"
                            Modal="returnedModal"
                            @click="this.item = item"
                            :title="$t('UploadMedicine')"
                            Icon="bx bx-upload"
                        />
                    </td>

                </tr>
                <GrowingLoader v-if="loader" Cols="10"/>

            </BasicTable>
            <ToPay></ToPay>

            <div class=" w-100 d-flex justify-content-end">
                <div class="col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-nowrap mb-0">
                                    <tbody>
                                    <tr>
                                        <th scope="row">{{$t('Subtotal')}} :</th>
                                        <td>{{counterStore.formatNumber(document.subtotal)}} {{counterStore.user.currency.sign}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{$t('AmountToPaid')}} :</th>
                                        <td>{{counterStore.formatNumber(document.loan_amount)}} {{counterStore.user.currency.sign}}</td>
                                    </tr>
                                    </tbody>

                                </table>

                            </div>
                            <br>
                            <BtnBox>
                                <PrimaryModalBtn  Modal="documentToPayModal" v-if="document.loan_amount > 0" :Loader="loader" >{{ $t('ToPay') }}</PrimaryModalBtn>
                            </BtnBox>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>
        <ModalCentered
            ModalName="returnedModal"
            :Title="$t('UploadMedicine')"
            @onModal="returnedMedicine()"
        >
            <DefaultInput
                :Label="$t('ReturnedMedicineAmount') + ' (' +$t('Maximum') + ': ' + item.amount+')'"
                Name="returned_amount"
                Type="number"
                :Max="item.current_amount"
                :Validated="errors"
                :Value="amount"
                @onInput="amount = $event,  delete this.errors.returned_amount"
            />

            <DefaultInput
                :Label="$t('Qancha pul qaytarib olindi') + ' ('+ $t('Maximum')+': ' +counterStore.formatNumber(document.amount_paid) +' '+ sign + ')'"
                Name="returned_price"
                Type="text"
                :Validated="errors"
                :Value="counterStore.formatNumber(this.returned_price)"
                inputClass ='returned_price'
                @onInput="addPrice($event),  delete this.errors.returned_price"

            />

        </ModalCentered>
        <toPay :Item="document" @onPayment="showDocument()" :paymentTypes="paymentTypes" ></toPay>
    </Page>
</template>
<script>
    import Page from "@/components/layout/Page.vue";
    import {ApiError} from "@/helpers/Config.js";
    import {Alert} from "@/helpers/Config.js";
    import {useConterStore} from "@/store/counter.js";
    import BasicTable from "@/components/all/BasicTable.vue";
    import {
        box_sizeActives,
        drug_companyActives,
        size_typeActives,
        medicine_categoryActives,
        payment_types, documentShow, imported_medicineShow, returned_medicineCreate
    } from "@/helpers/api.js";
    import GrowingLoader from "@/components/all/GrowingLoader.vue";
    import PrimaryButton from "@/components/all/PrimaryButton.vue";
    import PrimaryIconBtn from "@/components/all/PrimaryIconBtn.vue";
    import ModalCentered from "@/components/all/ModalCentered.vue";
    import PrimaryBtn from "@/components/all/PrimaryBtn.vue";
    import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
    import Paginate from "@/components/all/Paginate.vue";
    import DefaultSelect from "@/ui-components/Forms/DefaultSelect.vue";
    import Header from './header.vue';
    import Report from './report.vue';
    import CreateMedicine from '../Medicines/create.vue';
    import Create from "@/pages/Medicines/create.vue";
    import Update from "@/pages/Medicines/update.vue";
    import Search from "./search.vue";
    import DefaultIconInput from "@/components/all/DefaultIconInput.vue";
    import IconSelect from "@/components/all/IconSelect.vue";
    import BasicInput from "@/components/all/BasicInput.vue";
    import BasicSelect from "@/components/all/BasicSelect.vue";
    import PrimaryModalBtn from "@/components/all/PrimaryModalBtn.vue";
    import paymentTypes from "@/pages/PaymentTypes/index.vue";
    import toPay from "@/pages/Documents/toPay.vue";
    export default {
        components: {
            toPay,
            PrimaryModalBtn,
            BasicSelect,
            BasicInput,
            IconSelect,
            DefaultIconInput,
            Update,
            Create,
            DefaultSelect,
            Paginate,
            DefaultInput,
            PrimaryBtn,
            ModalCentered, PrimaryIconBtn, PrimaryButton, GrowingLoader, BasicTable, Page,Header, Report,Search, CreateMedicine},
        setup(){
            const counterStore = useConterStore();
            return{counterStore}
        },
        data(){return{
            change: false,
            isChange: false,
            items: [],
            mloader: false,
            item: [],
            boxItem: [],
            paginateCount: 10,
            last_page: 1,
            current_page: 1,
            boxLast_page: 1,
            boxCurrent_page: 1,
            column: 'id',
            type: 'desc',
            loader: false,
            boxLoader: false,
            boxItems: [],
            medicines: [],
            document: [],
            sortId: 1,
            paymentTypes: [],
            paid: 0,
            subtotal: 0,
            payment_type_id: null,
            dataErrors:[],
            amount: 0,
            errors: [],
            returned_price: 0,
            sign: ''
        }},
        methods:{
            addPrice(val){
                let formatAmount = this.counterStore.inputNumberFormat('returned_price', this.returned_price, val);
                console.log('all', formatAmount);
                this.returned_price = formatAmount;
            },
            async returnedMedicine(){
                try {
                    this.loader = true;
                    if (this.amount == 0 && this.returned_price == 0){
                        this.errors['returned_amount'] = ' ';
                        this.errors['returned_price'] = ' ';
                        this.loader = false;
                        return true;
                    }else if(this.item.amount < this.amount){
                        Alert('error',  this.$t('ReturnedMaxError'));
                        this.errors['returned_amount'] = this.$t('ReturnedMaxError');
                        this.loader = false;
                        return false;
                    }else if(this.item.current_amount < this.amount){
                        Alert('error',  this.$t('WarehouseNotLeft'));
                        this.errors['returned_amount'] = this.$t('WarehouseNotLeft');
                        this.loader = false;
                        return false;
                    }else if(this.document.amount_paid < this.returned_price){
                        Alert('error',  this.$t('ReturnedAmountError'));
                        this.errors['returned_price'] = this.$t('ReturnedAmountError');
                        this.loader = false;
                        return false;
                    }
                    this.errors = [];

                    let data = {
                        document_id: this.document.id,
                        supplier_id: this.document.supplier_id,
                        warehouse_id: this.document.warehouse_id,
                        payment_type_id: this.payment_type_id,
                        medicine: this.item,
                        returned_amount: this.amount,
                        returned_price: this.returned_price,
                        currency_id: this.counterStore.user.currency.id,
                    }
                    const response = await returned_medicineCreate(data);
                    if (response.status){
                        this.amount = 0;
                        this.show();
                        this.showDocument();
                        Alert('success', this.$t('ReturnedSuccess'));
                        this.counterStore.hiddenModal('returnedModal');
                        this.loader = false;
                        return true;
                    }
                    this.errors = response.errors;
                    Alert('error', this.$t('formError'));
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            deleteError(id){
                this.isChange = !this.isChange;
                this.dataErrors = this.dataErrors.filter(number => (number != 'date'+id && number != 'buy_price'+id && number != 'bu_amount'+id ));
            },
            async show(){
                try {
                    this.loader = true;
                    const response = await imported_medicineShow(this.$route.query.id);
                    this.medicines = response.data;
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async showDocument(){
                try {
                    const response = await documentShow(this.$route.query.id);
                    this.document = response.data;
                    this.sign = response.data.currency.sign
                }catch(error){
                    ApiError(this, error);
                }
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

            async search(text = ''){
                try {
                    this.loader = true;
                    if (text == ''){
                        this.indexPaginates();
                        return true;
                    }
                    const response = await documentSearch(text);
                    this.items = response.data;
                    this.loader = false;
                    if (!response.status){
                        Alert('error', this.$t('formError'));
                        this.loader = false;
                        return false;
                    }
                    this.loader = false;
                    return true;
                }catch(error){
                    ApiError(this, error);
                    this.loader = false;
                    return false;
                }
            },
            async delete(id){
                try {
                    if (!confirm(this.$t('DeleteAlert'))){
                        return false;
                    }
                    const response = await documentDelete(id);
                    if (response.status){
                        this.indexPaginates(this.current_page)
                        Alert('success', this.$t('delete'));
                        return;
                    }
                    Alert('error', this.$t('formError'));
                    return false;
                }catch(error){
                    ApiError(this, error);
                    return false;
                }
            },

        },
        mounted() {
            this.show();
            this.showDocument();
            this.indexPaymentTypes()
        }
    }
</script>
<style></style>
