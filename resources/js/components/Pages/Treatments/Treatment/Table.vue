<template>
    <div class="col-span-12 xl:col-span-12">
        <!-- Breadcrumb Start -->
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between " style="justify-content: flex-end">

            <nav >
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium cursor-pointer" @click = "this.$router.push('/treatmetns')"> {{getName('Treatmetns')}} /</a></li>
                    <li  class=" font-medium text-primary">{{getName('Treatment')}}</li>
                </ol>
            </nav>
        </div>

        <h4 class="text-title-md font-bold text-black dark:text-white mb-5">
            {{Patient.first_name + ' '+Patient.last_name}}
        </h4>




        <div class="w-full flex justify-content-end" style="justify-content: flex-end">
            <PrimaryButton style="width: 150px"
                 @click = "this.$router.push({ path: '/treatmetn/add-service', query:{ id: this.$route.query.id, treatment_id: $route.query.treatment_id }})"
                :Title="getName('addService')"
            />
        </div>
        <br>


        <Map01 :Title = "getName('PatientAbout')" >
            <table class="table01 mt-5"  >

                <tr>
                    <th>{{getName('services')}}</th>
                    <th>{{getName('ServiceCount')}}</th>
                    <th>{{getName('price')}}</th>
                    <td></td>
                </tr>

                <tr
                    v-for="item in Items"
                >

                    <td>{{ item.name }}</td>
                    <td style="width: 250px">

                        <Input
                            style="width: 200px; margin-right:  20px;"
                            Type="number"
                            Label = ""
                            @onInput = "addCount($event, item)"
                            :Value = "searchKey(item.id)"
                            :Class=" 'ui_input' + item.id "

                        />

                    </td>
                    <td style="font-weight: bold; ">{{ counterStore.formatNumber( Number(item.service_total_sum) * searchKey(item.id) ) }} uzs</td>
                    <td style="text-align: center; width: 100px">
                        <i @click = "removeItem(item.id)" class="fa-solid  text-danger fa-trash setting-icon cursor-pointer"></i>
                    </td>
                </tr>

            </table>

            <div style="width: 100%; display: flex; justify-content: flex-end">
                <p style="color: #3C50E0; font-weight: bold; font-size: 30px; margin: 20px 0">
                    {{ counterStore.formatNumber(summCount())  }} uzs
                </p>
            </div>
            <div class="w-full flex justify-content-end" style="justify-content: flex-end" >
                <PrimaryButton style="width: 150px"
                               @click = "saveTreatment()"
                               :Title="getName('Save')"
                />
            </div>
        </Map01>


    </div>

</template>
<script>
import {useConterStore} from "../../../../store/counter.js";
import TableHeader from "./Table-header.vue";
import {patientShow,treatmentAddServiceAll, treatmentSavedService} from "../../../../Api.js";
import Contents from "../../../../ui-components/Element/Contents.vue";
import ContentBox from "../../../../ui-components/Element/Contents/ContentBox.vue";
import ContentBlock from "../../../../ui-components/Element/Contents/ContentBlock.vue";
import Treatments from "../../Treatments/Table.vue";
import Payments from "../../Payments/Table.vue";
import Map01 from "../../../../ui-components/Element/map-01.vue";
import Input from "@/ui-components/Form/Input.vue";
import PrimaryButton from "@/ui-components/Form/PrimaryButton.vue";
import Item from "@/components/Pages/Employees/Calendar/Item.vue";
import {Alert} from "@/Config.js";
export default {
    components: {Input, PrimaryButton, Map01, ContentBlock, ContentBox, Contents, TableHeader, Treatments, Payments},
    setup(){
        const counterStore = useConterStore();
        return{counterStore}
    },
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
            Payments: null,
            Items: [],
            Services: [],
        }
    },
    methods:{
        addCount(value, item){

            let val = value;
            const uiInput = document.querySelector('.ui_input'+ item.id);
            if (Number(val) > Number(item.max_count)){
                uiInput.value = item.max_count;
                val = item.max_count;
                Alert('error', this.getName('ProductMin'));
            }

            let index = null;
            if(val <= 0){
                // this.Services = this.Services.filter(service => service.id != item.id);
                // this.$emit('sendId', item );
                // return  true;
            }
            this.Services.forEach((service, i) => {
                if (service.id == item.id){
                    index = i
                    return true;
                }
            })



            if (index == null){
                this.Services.push({
                    id: item.id,
                    count: val,
                })
            }else {
                this.Services[index].count = val;
            }


        },


        async saveTreatment(){
            let Arrs = [];
            if (this.Items.length > 0){
                this.Items.forEach((item)=>{
                    let model = null;

                    this.Services.forEach((service)=>{
                        if (item.id == service.id){
                            model = service;
                            return true;
                        }
                    })

                    if (model != null){
                        Arrs.push({
                            id: model.id,
                            count: model.count > '' ? model.count : 1,
                        });
                    }else {
                        Arrs.push({
                            id: item.id,
                            count: 1
                        });
                    }

                })


                if (Arrs.length > 0){
                    let data = {
                        items: Arrs,
                        treatment_id: this.$route.query.treatment_id
                    }
                    console.log('DAta:', data);
                    const response = await treatmentSavedService(data);
                    console.log('repomse', response)

                    if (response.status){
                        this.$router.push('/treatmetns');
                    }else {
                        this.errorObj = response.data;
                    }
                }

            }



        },

        summCount(){
            let summ = 0;
            this.Services.forEach((e)=>{
                let price = 0;
                this.Items.forEach((item) =>{
                    if (e.id == item.id){
                        price = Number(item.service_total_sum);
                    }
                })
                summ += Number(e.count) * price;
            })
            return summ;
        },
        searchKey(id){
            let result = null;
            this.Services.forEach((service, index) => {
                if (service.id == id){
                    result = index;
                    return true;
                }
            })

            if (result != null){
                return this.Services[result].count;
            }

            return 1;
        },
        router() {
            return router
        },
        removeItem(id){
            this.Services = this.Services.filter(service => service.id != id);
            this.Items = this.Items.filter(service => service.id != id);
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
        async getItems(){
            this.Items = [];
            const response = await treatmentAddServiceAll(this.$route.query.treatment_id);
            this.Items =  response.data.items;
            this.Items.forEach((e)=>{
                this.Services.push({
                    id: e.id,
                    count: e.count,
                })
            })

        },





    },
    mounted() {
        this.getItem()
        this.getItems()
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
