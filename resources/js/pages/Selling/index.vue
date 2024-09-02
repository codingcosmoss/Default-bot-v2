<template>
    <Layout @onSearch="search($event)">
        <template v-slot:customers>
            <DefaultSelect
                Label=""
                Name="customer"
                Class="col-6"
                :Validated="errors"
                @onInput="customer = JSON.parse($event),  delete this.errors.customer"
            >
                <option selected :value="JSON.stringify({name:'---', id: 0})">{{$t('Customers')}}</option>
                <option v-for="customer in customers" :value="JSON.stringify(customer)" >{{customer.name}}</option>

            </DefaultSelect>
            <button type="button"  v-if="counterStore.hasRole('Customers-create')" role="button" data-bs-toggle="modal" data-bs-target="#customerCreate"  class="btn btn-primary waves-effect waves-light">{{$t('CreateCustomer')}}</button>
        </template>
        <template v-slot:main>
                <ul class="main_list" >
                    <li class="font-size-15" >{{$t('Subtotal')}}: <span class="font-size-20 fw-bold">{{counterStore.formatNumber(resultSum().toFixed(2))}} {{sign}}</span></li>
                    <li class="font-size-15" >{{$t('PaidAmount')}}:
                        <input
                            type="text"
                            :value="counterStore.formatNumber(amount_due)"
                            class="amount_due selling_amount"
                            @input="sellingAmount($event.target.value)"
                        />
                    </li>
                    <li class="font-size-15 " >{{$t('AmountToPaid')}}: <span :class="resultSum() - amount_due < 0 ? 'text-bg-danger' : '' " class=" font-size-20 fw-bold">{{counterStore.formatNumber( (resultSum() - amount_due).toFixed(2) )}} {{sign}}</span></li>
                </ul>
            <button @click="amount_due = resultSum()" type="button" class="selling_btn btn bg_color_yello waves-effect waves-light">
                {{$t('FullPaid')}}
            </button>
            <button @click="cashPayment()" type="button" class="selling_btn btn btn-success waves-effect waves-light">
                <p v-if="!cashPaymentLoader" class="m-0">{{$t('CashPayment')}}</p>
                <div v-if="cashPaymentLoader" class="spinner-border text-success spinner-grow-sm m-4 mt-0 mb-0"  role="status">
                </div>
            </button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#changePayment" class="selling_btn btn btn-success waves-effect waves-light">
                {{$t('MFSPayment')}}
            </button>
        </template>
        <template v-slot:left>
            <BasicTable Title=""
                        :Th="[ $t('MedicineName'),$t('Batch'),$t('ExpiryDateFinished'),$t('Amount'),$t('Price'),$t('Total'), ''] "
                            Col="col-lg-12"
                >
                    <tr v-for="(medicine, index) in sellingMedicines" >
                        <td class="text-wrap font-size-10" >{{medicine.name}}</td>
                        <td>
                            <BasicSelect2
                                style="min-width: 100px"
                                Label=""
                                :isButton="true"
                                :Name="'batch_id'+medicine.id"
                                :Validated="errors"
                                @onInput="onBatch(index, $event)"
                            >
                                <option v-for="batch in medicine.batches" :selected="sellingMedicines[index]['batch_id'] == batch.id" :value="JSON.stringify(batch)" >{{batch.name}}  ({{batch.amount}})
                                </option>
                            </BasicSelect2>
                        </td>
                        <td>{{sellingMedicines[index]['expiration_date']}}</td>
                        <td>
                            <div style="min-width: 130px">
                                <AmountInput
                                    Label=""
                                    inputClass="selling_amount_input "
                                    :Name="medicine.id"
                                    Pholder=""
                                    Type="number"
                                    :isError="inputErrors.includes(medicine.id)"
                                    :Value="sellingMedicines[index]['selling_amount']"
                                    @onInput="changeItemAmount(index, $event)"
                                    @onPlus="changeAmount('plus', index)"
                                    @onMinus="changeAmount('minus', index)"
                                />
                            </div>

                        </td>
                        <td>{{counterStore.formatNumber(medicine.price)}} {{medicine.currency.sign}} </td>
                        <td>{{counterStore.formatNumber( (medicine.price * medicine.selling_amount).toFixed(2) )}} {{medicine.currency.sign}}</td>
                        <td>
                            <PrimaryIconBtn  @click="onDelete(medicine.sortId), gstCalculator()" class="bg-danger border-danger" Icon="bx bx-trash-alt"/>
                        </td>
                    </tr>
                </BasicTable>

            <div class="row p-4 pt-0 w-100">
                <div class="col-xl-6 col-lg-6">
                    <h4 class="card-title mb-4">{{$t('Customer')}} : <span class="text-bg-primary p-1" >{{customer.name}}</span></h4>
                    <div class="table-responsive">
                        <table class="table table-nowrap mb-0">
                            <tbody>
                            <tr>
                                <th scope="row">{{$t('Total')}} :</th>
                                <td>{{counterStore.formatNumber(sumAmount().toFixed(2))}} {{sign}}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="pt-3">{{$t('GST/TaxAmount')}} % :</th>
                                <td >
                                    <DefaultIconInput
                                        Label=""
                                        :Value="gst"
                                        @onInput="gst = $event, gstCalculator()"
                                    >
                                        %
                                    </DefaultIconInput>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">{{$t('IGTA')}} :</th>
                                <td>{{counterStore.formatNumber(sumIgta().toFixed(2))}} {{sign}}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{$t('Subtotal')}} :</th>
                                <td>{{counterStore.formatNumber((subtotal + igta + gstResult).toFixed(2))}} {{sign}}</td>
                            </tr>
                            <tr>
                                <th scope="row">{{$t('AmountPaid')}} :</th>
                                <td>{{counterStore.formatNumber(amount_due.toFixed(2))}} {{sign}}</td>
                            </tr>

                            </tbody>
                        </table><br/>
                    </div>
                </div>
            </div>

            </template>

            <div class="row p-2 selling_item_box position-relative ">
                <SellingCard
                    v-for="medicine in searchMedicines"
                    :Title="medicine.name"
                    :Text="medicine.generic_name"
                    :Amount="realAmount(medicine)"
                    :Image="medicine.image[0].url"
                    @click="addMedicines(medicine)"
                />

                <div v-if="!loader && searchMedicines.length == 0" class="text-center p-3">
                    <p>{{$t('MedicinesNotFount')}}</p>
                </div>

                <div v-if="loader" class="selling_loader_box" >
                    <div class="spinner-border text-primary m-1" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>


            </div>


        <audio class="onClickSong" :src=" counterStore.baseUrl + '/Songs/click.mp3' "  ></audio>
        <audio class="onErrorSong" :src=" counterStore.baseUrl + '/Songs/error.mp3' "  ></audio>
        <audio class="onSuccessSong" :src=" counterStore.baseUrl + '/Songs/success.mp3' "  ></audio>
        <ModalCentered
            ModalName="changePayment"
            :isModalFooter="false"
            :Title="$t('MFSPayments')"
        >
            <button
                type="button" class="btn btn-secondary btn-rounded waves-effect waves-light"
                style="margin-right: 10px"
                v-for="paymentType in paymentTypesArr"
                @click="cashPayment(paymentType.id)"
            >{{paymentType.name}}</button>
        </ModalCentered>
        </Layout>
    <CustomerCreate  @onCreate="indexCustomers" />

</template>
<script>
    import Page from "@/components/layout/Page.vue";
    import {useConterStore} from "@/store/counter.js";
    import Layout from './layout.vue';
    import SellingCard from "@/components/all/SellingCard.vue";
    import BasicTable from "@/components/all/BasicTable.vue";
    import {
        medicineActiveSearch,
        medicinePaginates,
        customerActives,
        customers,
        invoiceCreate,
        payment_typeActives,
        quantityVerification
    } from "@/helpers/api.js";
    import {ApiError, Alert} from "@/helpers/Config.js";
    import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
    import BasicInput from "@/components/all/BasicInput.vue";
    import AmountInput from "@/components/all/AmountInput.vue";
    import PrimaryIconBtn from "@/components/all/PrimaryIconBtn.vue";
    import DefaultIconInput from "@/components/all/DefaultIconInput.vue";
    import PrimaryBtn from "@/components/all/PrimaryBtn.vue";
    import DefaultSelect from "@/ui-components/Forms/DefaultSelect.vue";
    import Swal from 'sweetalert2'
    import ModalCentered from "@/components/all/ModalCentered.vue";
    import CustomerCreate from "../Customers/create.vue"
    import BasicSelect from "@/components/all/BasicSelect.vue";
    import BasicSelect2 from "@/components/all/BasicSelect2.vue";

    export default {
        components: {
            BasicSelect2,
            BasicSelect,
            ModalCentered,
            DefaultSelect,
            PrimaryBtn,
            DefaultIconInput,
            PrimaryIconBtn, AmountInput, BasicInput, DefaultInput, BasicTable, SellingCard, Layout, CustomerCreate},
        setup(){
            const counterStore = useConterStore();
            return{counterStore}
        },
        data(){return{
            items: [],
            item: [],
            searchText: '',
            paginateCount: 10,
            last_page: 1,
            current_page: 1,
            column: 'id',
            type: 'desc',
            errors: [],
            headers: [],
            // __________
            searchMedicines:[],
            sellingMedicines: [],
            sortId: 0,
            loader: false,
            // __________
            sign: '',
            subtotal: 0,
            gst: 0,
            igta: 0,
            inputErrors:[],
            gstResult: 0,
            customer: {
                id:0,
                name: '---'
            },
            customers:[],
            amount_due: 0,
            cashPaymentLoader: false,
            paymentTypesArr: []
        }},

        methods:{
            onBatch(index, batch){
                if (!batch){
                    this.sellingMedicines[index]['batch_id'] = null;
                    this.sellingMedicines[index]['amount'] = 0;
                    this.sellingMedicines[index]['selling_amount'] = 0;
                    this.sellingMedicines[index]['expiration_date'] = '---';
                }else {
                    batch = JSON.parse(batch);
                    this.sellingMedicines[index]['batch_id'] = batch.id;
                    this.sellingMedicines[index]['amount'] = batch.amount;
                    this.sellingMedicines[index]['selling_amount'] = 0;
                    this.sellingMedicines[index]['expiration_date'] = batch.expiry_date_finished;
                    this.changeAmount('plus', index);
                }

            },
            onClickSong(){
                let song = document.querySelector('.onClickSong');
                // Agar audio ijro etilayotgan bo'lsa
                if (!song.paused) {
                    song.pause();            // Avval audio to'xtatiladi
                    song.currentTime = 0;    // Audio joriy o'rni boshiga qaytariladi
                }

                song.play();  // Audio qayta ijro etiladi
            },
            onErrorSong(){
                let song = document.querySelector('.onErrorSong');
                // Agar audio ijro etilayotgan bo'lsa
                if (!song.paused) {
                    song.pause();            // Avval audio to'xtatiladi
                    song.currentTime = 0;    // Audio joriy o'rni boshiga qaytariladi
                }

                song.play();  // Audio qayta ijro etiladi
            },
            onSuccessSong(){
                Swal.fire({
                    title: this.$t('Successfully'),
                    text: "",
                    icon: "success"
                });
                let song = document.querySelector('.onSuccessSong');
                // Agar audio ijro etilayotgan bo'lsa
                if (!song.paused) {
                    song.pause();            // Avval audio to'xtatiladi
                    song.currentTime = 0;    // Audio joriy o'rni boshiga qaytariladi
                }

                song.play();  // Audio qayta ijro etiladi
            },
            dataRefresh(){
                this.sellingMedicines = [];
                this.subtotal = 0;
                this.igta = 0;
                this.gst = 0;
                this.amount_due = 0;
            },
            async cashPayment(type=null){
                try {
                    this.cashPaymentLoader = true;

                    if (this.customer.id == 0){
                        this.onErrorSong();
                        this.errors['customer'] = this.$t('CustomerValidated');
                        Alert('error', this.$t('CustomerValidated'))
                        this.cashPaymentLoader = false;
                        return false;
                    }
                    if (this.amount_due > this.resultSum()){
                        this.onErrorSong();
                        Alert('error', this.$t('PaymentMaxError'))
                        this.cashPaymentLoader = false;
                        return false;
                    }
                    if (this.sellingMedicines.length == 0){
                        this.onErrorSong();
                        Alert('error', this.$t('MedicinesValidated'))
                        this.cashPaymentLoader = false;
                        return false;
                    }

                    let amount = 0;
                    this.sellingMedicines.forEach(e=>{
                        amount+= Number(e.selling_amount);
                    })
                    let paymentType = null;
                    if (type == null){
                        paymentType = this.paymentTypesArr.find(e=> e.status == 9).id;
                    }else {
                        paymentType = type;
                    }
                    let data = {
                        customer_id: this.customer.id,
                        amount: amount,
                        amount_paid: this.amount_due,
                        must_paid: this.resultSum() - this.amount_due,
                        subtotal: this.resultSum(),
                        igta: this.igta,
                        gst: this.gst,
                        medicines: this.sellingMedicines,
                        currency_id: this.counterStore.user.currency.id,
                        payment_type_id: paymentType
                    }
                    const response = await invoiceCreate(data);
                    if (response.status){
                        this.counterStore.hiddenModal('changePayment');
                        this.dataRefresh()
                        this.onSuccessSong();
                        // Alert('success', this.$t('save'));
                        this.search();
                        this.cashPaymentLoader = false;
                        return true;
                    }else{
                        this.onErrorSong();
                        if (response.medicines.length > 0){
                            this.amountErrorFix(response.medicines);
                            return false;
                        }else {
                            this.errors = response.errors;
                            this.cashPaymentLoader = false;
                            return false;
                        }
                    }

                }catch(error){
                    ApiError(this, error);
                    this.cashPaymentLoader = false;
                    return false;
                }
            },
            async amountErrorFix(medicines){
                medicines.forEach((e) =>{
                    let index = this.sellingMedicines.findIndex(i=> i.id == e.id );
                    this.sellingMedicines[index]['selling_amount'] = e.amount;
                    this.sellingMedicines[index]['amount'] = e.amount;
                    this.sellingMedicines[index]['batches'] = e.batches;
                    if (e.amount > 0){
                        this.sellingMedicines[index]['batch_id'] = e.batches[0]['id'];
                    }
                    this.inputErrors.push(e.id);
                });
                this.amount_due = 0;
                Swal.fire({
                    title: this.$t('SellingError'),
                    text: "",
                    icon: "info"
                });
                this.search(this.searchText);
                this.cashPaymentLoader = false;
            },
            resultSum(){
                let sum = this.subtotal + this.igta + this.gstResult;
                return Math.round(sum * 100) / 100;
            },
            sellingAmount(val){
                let formatAmount = this.counterStore.inputNumberFormat('amount_due', this.amount_due, val);
                this.amount_due = formatAmount;
            },
            gstCalculator(){
                this.gstResult = (this.subtotal * this.gst)/100
            },
            changeItemAmount(index, amount){
                let medicine = this.sellingMedicines[index];
                if (medicine['amount'] < amount){
                    this.onErrorSong();
                    Alert('error', this.$t('MedicineNotAmount'));
                    this.inputErrors.push(medicine['id']);
                }else {
                    this.inputErrors = this.inputErrors.filter(e=> e != medicine['id'])
                    this.sellingMedicines[index]['selling_amount'] = amount;
                }
            },
            sumAmount(){
                let sum = 0;
                this.sellingMedicines.forEach(e=>{
                    sum+= e.price * e.selling_amount;
                })
                this.subtotal = sum;
                this.gstCalculator();
                return Number(sum);
            },
            sumIgta(){
                let sum = 0;
                this.sellingMedicines.forEach(e=>{
                    sum+= e.igta * e.selling_amount;
                })
                this.igta = sum;
                return Number(sum);
            },
            onDelete(id){
                this.sellingMedicines = this.sellingMedicines.filter(e=>e.sortId != id);
                this.sumAmount();
            },
            async indexCustomers(){
                try {
                    const response = await customers();
                    this.customers = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async indexPaymentTypes(){
                this.sign = this.counterStore.user.currency.sign;
                try {
                    const response = await payment_typeActives();
                    this.paymentTypesArr = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            changeAmount(type, index, amount=1){
                let medicine = this.sellingMedicines[index];
                if (medicine['batch_id'] == null || medicine['batch_id'] < 1){
                    this.errors['batch_id'+medicine.id] = 'error';
                    Alert('error', this.$t('BatchValidated2'));
                    return;
                }
                if (type == 'plus'){
                    if (medicine.amount < medicine.selling_amount + amount){
                        this.onErrorSong();
                        Alert('error', this.$t('MedicineNotAmount'))
                        return false
                    }else {
                        this.sellingMedicines[index]['selling_amount'] +=amount;

                    }
                    this.inputErrors = this.inputErrors.filter(e=> e != medicine['sortId'])
                }else {
                    if ( 0 >= medicine.selling_amount - amount){
                        this.onErrorSong();
                        return false
                    }else {
                        this.sellingMedicines[index]['selling_amount'] -=amount;
                        this.inputErrors = this.inputErrors.filter(e=> e != medicine['id'])
                    }

                }
            },
            addMedicines(item){
                this.onClickSong();
                if (this.realAmount(item) <= 0){
                    Alert('error', this.$t('MedicineNotAmount'))
                    return false
                }
                let index = this.sellingMedicines.findIndex(i => i.id == item.id);
                if (index != -1){
                    this.changeAmount('plus', index)
                    return true;
                }

                let id = this.sortId + 1;
                let newMedicine = { ...item };
                newMedicine['sortId'] = id;
                newMedicine['selling_amount'] = 1;
                newMedicine['expiration_date'] = item.batches[0]['expiry_date_finished'];
                newMedicine['batch_id'] = item.batches[0]['id'];
                newMedicine['amount'] = item.batches[0]['amount'];
                newMedicine['is_error'] = 0;
                this.sortId = id;

                this.sellingMedicines.push(newMedicine);
                this.sumAmount();
            },
            realAmount(val){
                let medicine = this.sellingMedicines.find(item => item.id == val.id);
                if (medicine){
                    return val.amount - medicine.selling_amount;
                }else {
                    return val.amount;
                }
            },
            async search(val = ''){
                try {
                    this.searchText = val;
                    this.loader = true;
                    this.searchMedicines = [];
                    if (this.searchText == ''){
                        this.searchText = 'all';
                    }
                    const response = await medicineActiveSearch(this.searchText);
                    this.searchMedicines = response.data;
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
            async indexPaginates(page=1){
                try {
                    this.sign = this.counterStore.user.currency.sign;
                    this.loader = true;
                    const response = await medicinePaginates(10, page);
                    this.searchMedicines = response.data.items;
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async quantityVerification(){
                try {
                    this.loader = true;
                    const response = await quantityVerification();
                    if (response.status){
                        await this.search()
                    }
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
        },

        mounted() {
            this.quantityVerification()
            this.indexCustomers()
            this.indexPaymentTypes()
        }
    }
</script>
<style></style>
