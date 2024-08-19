<template>
    <Page Title=""
          :Links="[
                    {
                        path: '/admin/returned/invoices',
                        name: $t('SellingArxive'),
                        status: false
                    },
                    {
                        path: '/',
                        name: $t('Print'),
                        status: true
                    }
                ]"
    >
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                <Loader v-if="loader" ></Loader>
                    <div v-if="!loader" class="card-body">
                        <div class="text-center">
                            <img :src="logo" width="150px" >
                            <h2>{{company.name}}</h2>
                            <p>
                                {{$t('Phone')}}: {{company.phone}},
                                {{$t('Email')}}: {{company.email}},
                                {{$t('Address')}}: {{company.address}},
                            </p>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6  print_td_left">
                                <address>
                                    <strong>{{$t('Date')}}:</strong><br>
                                    <strong>{{$t('InvoiceId')}}:</strong><br>
                                    <strong>{{$t('Customer')}}:</strong><br>
                                    <strong>{{$t('Seller')}}:</strong><br>
                                </address>
                            </div>
                            <div class="col-sm-6 text-sm-end print_td_right">
                                <address class="mt-2 mt-sm-0">
                                    {{invoice.date}}<br>
                                    {{invoice.id}}<br>
                                    {{customer.name}}<br>
                                    {{seller.name}}<br>
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 print_td_left mt-3">
                                <address>
                                    <strong>{{$t('PaymentType')}}:</strong><br>
                                    <strong>{{$t('Subtotal')}}:</strong><br>
                                    <strong>{{$t('Paid')}}:</strong><br>
                                    <strong>{{$t('Indebtedness')}}:</strong><br>
                                </address>
                            </div>
                            <div class="col-sm-6 mt-3 text-sm-end print_td_right">
                                <address>
                                    {{invoice.date}}<br>
                                    {{counterStore.formatNumber(invoice.subtotal)}} {{sign}}<br>
                                    {{counterStore.formatNumber(invoice.amount_paid)}} {{sign}}<br>
                                    {{counterStore.formatNumber(invoice.must_paid)}} {{sign}}<br>
                                </address>
                            </div>
                        </div>
                        <div class="py-2 mt-3 text-center">
                            <h3 class="font-size-15 fw-bold">{{$t('Invoice')}}</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-nowrap">
                                <thead>
                                <tr>
                                    <th style="width: 70px;">No.</th>
                                    <th>{{$t('MedicineName')}}</th>
                                    <th>{{$t('Amount')}}</th>
                                    <th>{{$t('Price')}}</th>
                                    <th>{{$t('Total')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(medicine, index) in medicines" >
                                    <td>{{index+1}}</td>
                                    <td>{{medicine.name}}</td>
                                    <td>{{medicine.amount}}</td>
                                    <td>{{counterStore.formatNumber(medicine.price)}} {{sign}}</td>
                                    <td>{{counterStore.formatNumber(medicine.subtotal)}} {{sign}}</td>
                                </tr>
                               <tr>
                                   <td colspan="5" class="border-0">
                                       <div class="d-flex w-100 justify-content-end gap-2">
                                           <p colspan="4" class="text-end">{{$t('Subtotal')}}:</p>
                                           <p  class="text-end">{{counterStore.formatNumber(invoice.subtotal)}} {{sign}}</p>
                                       </div>
                                   </td>
                               </tr>
                                <tr>
                                    <td colspan="5" class="border-0 text-center"><h4 class="m-0">{{$t('Paid')}}: {{counterStore.formatNumber(invoice.amount_paid)}} {{sign}}</h4></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-print-none">
                            <div class="float-end">
                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Page>
</template>
<script>
import Page from "@/components/layout/Page.vue";
import {useConterStore} from "@/store/counter.js";
import {invoiceShow} from "@/helpers/api.js";
import {ApiError} from "@/helpers/Config.js";
import Loader from "@/ui-components/Items/Loader.vue";

export default
{
    components: {Loader, Page},
    setup(){
        const counterStore = useConterStore();
        return{counterStore}
    },
    data(){return{
        loader: false,
        invoice: [],
        company: [],
        medicines: [],
        customer: [],
        seller: [],
        sign: [],
        logo:[]
    }},
    methods:{
        async show(){
            try {
                this.loader = true;
                const response = await invoiceShow(this.$route.query.id);
                this.invoice = response.data;
                this.company = response.data.company;
                this.customer = response.data.customer;
                this.seller = response.data.user;
                this.sign = response.data.currency.sign;
                this.logo = response.data.company.logo[0].url;
                this.medicines = response.data.sold_medicines;
                this.loader = false;
            }catch(error){
                ApiError(this, error);
            }
        },
    },
    mounted() {
        this.show()
    }

}
</script>
