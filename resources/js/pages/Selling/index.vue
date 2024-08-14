<template>
    <Layout @onSearch="search($event)">
        <template v-slot:main>
                <ul class="main_list" >
                    <li class="font-size-15" >{{$t('Subtotal')}}: <span class="font-size-20 fw-bold">1000</span></li>
                    <li class="font-size-15" >{{$t('Subtotal')}}: <input value="0" class="selling_amount " /></li>
                    <li class="font-size-15" >{{$t('AmountToPaid')}}: <span class="font-size-20 fw-bold">1000</span></li>
                </ul>
            <button type="button" class="selling_btn btn bg_color_yello waves-effect waves-light">
                {{$t('FullPaid')}}
            </button>
            <button type="button" class="selling_btn btn btn-success waves-effect waves-light">
                {{$t('CashPayment')}}
            </button>
            <button type="button" class="selling_btn btn btn-success waves-effect waves-light">
                {{$t('MFSPayment')}}
            </button>
        </template>
        <template v-slot:left>
            <BasicTable Title=""
                        :Th="[ $t('No'), $t('MedicineName'),$t('Amount'),$t('Price'),$t('Total'), ''] "
                            Col="col-lg-12"

                >
                    <tr v-for="(medicine, index) in sellingMedicines">
                        <td>{{index + 1}}</td>
                        <td>{{medicine.name}}</td>
                        <td>
                            <AmountInput
                                Label=""
                                inputClass="selling_amount_input"
                                :Name="medicine.sortId"
                                Type="number"
                                :Validated="errors"
                                :Value="sellingMedicines[index]['selling_amount']"
                                @onInput="$event,  delete this.errors.medicine.sortId"
                                @onPlus="changeAmount('plus', index)"
                                @onMinus="changeAmount('minus', index)"
                            />
                        </td>
                        <td>{{counterStore.formatNumber(medicine.price)}} {{medicine.currency.sign}} </td>
                        <td>{{counterStore.formatNumber(medicine.price * medicine.selling_amount)}} {{medicine.currency.sign}}</td>
                        <td>
                            <PrimaryIconBtn  @click="onDelete(medicine.sortId)" class="bg-danger border-danger" Icon="bx bx-trash-alt"/>
                        </td>
                    </tr>
                </BasicTable>

            <div class="row p-4 pt-0 w-100">
                <div class="col-xl-6 col-lg-6">
                    <h4 class="card-title mb-4">{{$t('PersonalInformation')}}</h4>
                    <div class="table-responsive">
                        <table class="table table-nowrap mb-0">
                            <tbody>
                            <tr>
                                <th scope="row">{{$t('Total')}} :</th>
                                <td>1000</td>
                            </tr>
                            <tr>
                                <th scope="row" class="pt-3">{{$t('GST/TaxAmount')}} % :</th>
                                <td >
                                    <DefaultIconInput
                                        Label=""
                                        Value="0"
                                    >
                                        %
                                    </DefaultIconInput>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">{{$t('IGTA')}} :</th>
                                <td>1000</td>
                            </tr>
                            <tr>
                                <th scope="row">{{$t('Subtotal')}} :</th>
                                <td>1000</td>
                            </tr>
                            <tr>
                                <th scope="row">{{$t('AmountPaid')}} :</th>
                                <td>1000</td>
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
                <div v-if="loader" class="selling_loader_box" >
                    <div class="spinner-border text-primary m-1" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>



        </Layout>
</template>
<script>
    import Page from "@/components/layout/Page.vue";
    import {useConterStore} from "@/store/counter.js";
    import Layout from './layout.vue';
    import SellingCard from "@/components/all/SellingCard.vue";
    import BasicTable from "@/components/all/BasicTable.vue";
    import {medicineActiveSearch, medicinePaginates} from "@/helpers/api.js";
    import {ApiError, Alert} from "@/helpers/Config.js";
    import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
    import BasicInput from "@/components/all/BasicInput.vue";
    import AmountInput from "@/components/all/AmountInput.vue";
    import PrimaryIconBtn from "@/components/all/PrimaryIconBtn.vue";
    import DefaultIconInput from "@/components/all/DefaultIconInput.vue";
    import PrimaryBtn from "@/components/all/PrimaryBtn.vue";

    export default {
        components: {
            PrimaryBtn,
            DefaultIconInput,
            PrimaryIconBtn, AmountInput, BasicInput, DefaultInput, BasicTable, SellingCard, Layout},
        setup(){
            const counterStore = useConterStore();
            return{counterStore}
        },
        data(){return{
            items: [],
            item: [],
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
            subtotal: 0
        }},
        methods:{
            onDelete(id){
                this.sellingMedicines = this.sellingMedicines.filter(e=>e.sortId != id);
            },
            changeAmount(type, index, amount=1){
                let medicine = this.sellingMedicines[index];
                if (type == 'plus'){
                    if (medicine.amount < medicine.selling_amount + amount){
                        Alert('error', this.$t('MedicineNotAmount'))
                        return false
                    }else {
                        this.sellingMedicines[index]['selling_amount'] +=amount;

                    }
                }else {
                    if ( 0 > medicine.selling_amount - amount){
                        return false
                    }else {
                        this.sellingMedicines[index]['selling_amount'] -=amount;
                    }
                }
            },
            addMedicines(item){
                if (this.realAmount(item) <= 0){
                    Alert('error', this.$t('MedicineNotAmount'))
                    return false
                }
                let index = this.sellingMedicines.findIndex(i => i.id == item.id);
                if (index != -1){
                    this.sellingMedicines[index]['selling_amount'] +=1;
                    return true;
                }

                let id = this.sortId + 1;
                let newMedicine = { ...item };
                newMedicine['sortId'] = id;
                newMedicine['selling_amount'] = 1;
                this.sortId = id;

                this.sellingMedicines.push(newMedicine);
            },
            realAmount(val){
                let medicine = this.sellingMedicines.find(item => item.id == val.id);
                if (medicine){
                    return val.amount - medicine.selling_amount;
                }else {
                    return val.amount;
                }
            },
            async search(text = ''){
                try {
                    this.loader = true;
                    if (text == ''){
                        this.indexPaginates();
                        return true;
                    }
                    const response = await medicineActiveSearch(text);
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
                    this.loader = true;
                    const response = await medicinePaginates(10, page);
                    this.searchMedicines = response.data.items;
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
        },

        mounted() {
            this.indexPaginates()
        }
    }
</script>
<style></style>
