<template >
    <div class="col-span-12 xl:col-span-12">
        <!-- Breadcrumb Start -->
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between " style="justify-content: flex-end">

            <nav >
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium cursor-pointer" @click = "this.$router.push('/patients')"> {{getName('Treatmetns')}} /</a></li>
                    <li  class=" font-medium text-primary">{{getName('Treatment')}}</li>
                </ol>
            </nav>
        </div>

        <h4 class="text-title-md font-bold text-black dark:text-white mb-5">
            {{Patient.first_name + ' '+Patient.last_name}}
        </h4>




        <Treatments :Header = "false" :Treatments = "Treatmets" ></Treatments>

        <br>


        <Map01 :Title = "getName('PatientAbout')" >
            <table class="table01 mt-5"  >

                <tr>
                    <th>{{getName('name')}}: &nbsp;&nbsp;</th>
                    <td>{{Patient.last_name}}</td>
                </tr>

                <tr>
                    <th>{{getName('last_name')}}: &nbsp;&nbsp;</th>
                    <td>{{ Patient.first_name }}</td>
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
                    <td>{{Patient.gender}}</td>
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
                </tr>
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
            Payments: null
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
            this.Treatmets = response.data.treatmets;
            this.Payments = response.data.payments;
        },





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
        color: #2E3A47 !important;

    }


</style>
