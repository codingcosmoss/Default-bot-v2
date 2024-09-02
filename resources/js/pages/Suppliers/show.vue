<template>
    <Page Title="" :Links="[
                    {
                        path: '/admin/suppliers',
                        name: this.$t('Suppliers'),
                        status: false
                    },
                    {
                        path: '/',
                        name: this.$t('PersonalInformation'),
                        status: true
                    }
                ]" >
        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-4">
                    <div class="card overflow-hidden">
                        <div class="bg-primary-subtle">
                            <div class="row">
                                <div class="col-7">

                                </div>
                                <div class="col-5 align-self-end">
                                    <img :src=" counterStore.baseUrl + '/assets/images/profile-img.png'" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <img :src="photo" alt="" class="img-thumbnail rounded-circle">
                                    </div>
                                    <h5 class="font-size-15 text-truncate">{{supplier.name}}</h5>
                                    <p class="text-muted mb-0 text-truncate font-size-10">{{$t('Supplier')}}</p>
                                </div>

                                <div class="col-sm-8">
                                    <div class="pt-4">
                                        <div class="row">
                                            <div class="col-6">
                                                <h5 class="font-size-15">{{supplier.imported_medicines}}</h5>
                                                <p class="text-muted mb-0">{{$t('ImportedMedicines')}}</p>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="font-size-15" v-for="paid in supplier.paid" >{{paid.total_amount.toFixed(2)}} {{paid.sign}}</h5>
                                                <p class="text-muted mb-0">{{ $t('Paid') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">{{$t('PersonalInformation')}}</h4>
                            <div class="table-responsive">
                                <table class="table table-nowrap mb-0">
                                    <tbody>
                                    <tr>
                                        <th scope="row">{{$t('Name')}} :</th>
                                        <td>{{supplier.name}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{$t('Address')}} :</th>
                                        <td>{{supplier.address}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{$t('Phone')}} :</th>
                                        <td>{{supplier.phone}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{$t('ImportedDrugs')}} :</th>
                                        <td>{{supplier.imported_medicines}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{$t('Paid')}} :</th>
                                        <td>
                                            <p class="m-0" v-for="paid in supplier.paid">{{paid.total_amount.toFixed(2)}} {{paid.sign}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{$t('Loan')}} :</th>
                                        <td>
                                            <p class="m-0" v-for="loan in supplier.loan">{{loan.total_amount.toFixed(2)}} {{loan.sign}}</p>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>

                <Medicines></Medicines>
            </div>
            <!-- end row -->


        </div>

    </Page>
</template>
<script>
import Page from "@/components/layout/Page.vue";
import {useConterStore} from "@/store/counter.js";
import {ApiError} from "@/helpers/Config.js";
import {Alert} from "@/helpers/Config.js";
import {supplierShow, imported_medicineSupplierMedicines} from "@/helpers/api.js";
import Medicines from './medicines.vue';
export default
{
    components:{Page, Medicines},
    setup(){
        const counterStore = useConterStore();
        return{counterStore}
    },
    data(){return{
        supplier: [],
        items: [],
        item: [],
        paginateCount: 10,
        last_page: 1,
        current_page: 1,
        column: 'id',
        type: 'desc',
        errors: [],
        headers: [],
        loader: false,
        photo: '',
        medicines: []
    }},
    methods:{
        async show(id){
            try {
                const response = await supplierShow(this.$route.query.id);
                this.supplier = response.data;
                this.photo = response.data.image[0].url
            }catch(error){
                ApiError(this, error);
            }
        }

    },
    mounted() {
        this.show()

    }
}
</script>
