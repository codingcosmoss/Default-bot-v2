<template >
    <div class="col-span-12 xl:col-span-12">
        <!-- Breadcrumb Start -->
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between " style="justify-content: flex-end">

            <nav >
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium cursor-pointer" @click = "this.$router.push('/patients')"> {{getName('Patients')}} /</a></li>
                    <li  class=" font-medium text-primary">{{getName('Patients')}}</li>
                </ol>
            </nav>
        </div>

        <h4 class="text-title-md font-bold text-black dark:text-white mb-5">
            {{Patient.first_name + ' '+Patient.last_name}}
        </h4>

        <ContentBox style="margin-bottom: 25px ">
            <ContentBlock
                :Title = "getName('ServicesUsed')"
                :Text = "Patient.services_used"
                Icon = "fa-solid fa-handshake"
                Item = ""
            />
            <ContentBlock
                :Title = "getName('AmountPaid')"
                :Text = "Patient.amount_paid"
                Icon = "fa-solid fa-money-check-dollar"
                Item = ""
            />
            <ContentBlock
                :Title = "getName('Indebtedness')"
                :Text = "Patient.debts"
                Icon = "fa-solid fa-file-invoice-dollar"
                Item = ""
            />
            <ContentBlock
                :Title = "getName('Balans')"
                :Text = "Patient.balans"
                Icon = "fa-solid fa-money-bills"
                Item = ""
            />
        </ContentBox>


        <Treatments :isPaginate = "false" @onPayment = "updateTreatment()" :Header = "false" :Treatments = "Treatmets" v-if="Treatmets.length > 0" ></Treatments>

        <br>
        <Payments :isPaginate = "false" :isIcons = "false" :Header = "false" :Payments = "Payments"  ></Payments>

        <br>

        <Map01 :Title = "getName('PatientAbout')" class="patient_table" >
            <table class="table01 mt-5" style="min-width: 818px;"  >

                <tr>
                    <th>{{getName('image')}}: &nbsp;&nbsp;</th>
                    <td>
                        <div class="photo-img" style="width: 100px; height: 100px" :style="'background-image: url(' + Image + ')'" >

                        </div>
                    </td>
                </tr>

                <tr>
                    <th>{{getName('fio')}}: &nbsp;&nbsp;</th>
                    <td>{{ Patient.first_name }} {{Patient.last_name}}</td>
                </tr>

                <tr>
                    <th>{{getName('phone')}}: &nbsp;&nbsp;</th>
                    <td>{{Patient.phone}}</td>
                </tr>

                <tr>
                    <th>{{getName('Job')}}: &nbsp;&nbsp;</th>
                    <td>{{Patient.job}}</td>
                </tr>

                <tr>
                    <th>{{getName('Gender')}}: &nbsp;&nbsp;</th>
                    <td>{{Patient.gender_text}}</td>
                </tr>

                <tr>
                    <th>{{getName('Date_birth')}}: &nbsp;&nbsp;</th>
                    <td>{{Patient.birthday}}</td>
                </tr>
                <tr>
                    <th>{{getName('Address')}}: &nbsp;&nbsp;</th>
                    <td>{{Patient.address}}</td>
                </tr>

                <tr>
                    <th>{{getName('diseases')}}: &nbsp;&nbsp;</th>
                    <td>
                        <p class="btn" v-for=" (item, index) in Patient.diseases" >{{index+1}}. {{item.name}}</p>
                    </td>

                 </tr >


                <tr>
                    <th>{{getName('services')}}: &nbsp;&nbsp;</th>
                    <td>
                        <table class="table01 mt-5"  >

                            <tr>
                                <th>{{getName('Service_name')}}</th>
                                <th>{{getName('TotalSum')}}</th>
                                <th>{{getName('Amount')}}</th>
                                <th>{{getName('ReceptionTime')}}</th>
                            </tr>
                            <tr v-for=" (service, index) in Services" >
                                <td>{{service.service_name}}</td>
                                <td>{{useConterStore().formatNumber(service.result_price)}} uzs</td>
                                <td>{{service.amount}}</td>
                                <td>{{useConterStore().formatDate(service.created_at)}}</td>

                            </tr >

                        </table>

                    </td>

                </tr >




                <tr>
                    <th>{{getName('Created_at')}}: &nbsp;&nbsp;</th>
                    <td>{{Patient.created_at}}</td>
                </tr>



            </table>

        </Map01>
    </div>

</template>
<script>
import {useConterStore} from "../../../../store/counter.js";
import TableHeader from "./Table-header.vue";
import {patientShow} from "../../../../Api.js";
import Contents from "../../../../ui-components/Element/Contents.vue";
import ContentBox from "../../../../ui-components/Element/Contents/ContentBox.vue";
import ContentBlock from "../../../../ui-components/Element/Contents/ContentBlock.vue";
import Treatments from "../../Treatments/Table.vue";
import Payments from "../../Payments/Table.vue";
import Map01 from "../../../../ui-components/Element/map-01.vue";
export default {
    setup(){
        return{useConterStore}
    },
    components: {Map01, ContentBlock, ContentBox, Contents, TableHeader, Treatments, Payments},
    data(){
        return{
            Patient: [],
            search: '',
            column: 'sort_order',
            order: 'asc',
            paginate: 10,
            pagination: {},
            current_page: 1,
            Treatmets: [],
            Payments: [],
            PaymentItems: [],
            Services: [],
            Image: ''
        }
    },
    methods:{
        router() {
            return router
        },
        getName(val){
            return useConterStore().getName(val)
        },
        async getItem(){
            const response = await patientShow(this.$route.query.id);
            this.Patient = response.data;
            this.Image = response.data.image[0].url;
            this.Treatmets = response.data.treatmets;
            this.Payments = response.data.payments;
            this.PaymentItems = response.data.items;
            this.Services = response.data.services;
        },
        async updateTreatment(){
            const response = await patientShow(this.$route.query.id);
            this.Treatmets = response.data.treatmets;
        }

    },
    mounted() {
        this.getItem()
    }
}
</script>
<style >
    .fa-solid{cursor: pointer}
    table {
        /* border-collapse: separate; */
        border-spacing: 30px; /* Masofani o'zgartiring */
    }
    tr{
        /* display: flex; */
        /* margin: 15px 0; */
    }
    td{
        margin-left: 30px;
    }

    .btn01{
        width: 100px;
        margin-left: 100px;
        background: rgba(0, 0, 0, 0.12);
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;

    }
    .contents{
        width: 100%;
        background: blueviolet;
        display: flex;
    }
    .btn01 svg{
        background: rgba(46, 58, 71, 0.07);
        border: 1px solid rgba(245, 245, 245, 0.33);
        margin: 0 10px;
        border-radius: 10px;
        color: white;
        cursor: pointer;
    }
    .btn01 svg:active{
        transform: scale(0.9);
    }
    .active{
        background: #10B981 !important;
        //color: #2E3A47 !important;

    }


</style>
