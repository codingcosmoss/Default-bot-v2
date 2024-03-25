<template>

    <div
        class="col-span-12 rounded-sm border border-stroke bg-white py-6 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4">
        <h4 class="mb-6 px-7.5 text-xl font-bold text-black dark:text-white">
            {{getName('DebtorFinishedTreatments')}}
        </h4>


        <div>

            <div
                v-for="item in Items"
               class="flex items-center gap-5 py-3 px-7.5 hover:bg-gray-3 dark:hover:bg-meta-4">

                <div class="flex flex-1 items-center justify-between">

                    <div class="item_box">
                        <h5 class="font-medium">{{item.patient_name}}</h5>
                        <p style="display: flex; justify-content: space-between">
                            <div>
                                <span class="text-sm font-medium">{{counterStore.formatNumber(item.doctor_sum)}}</span>
                                <span class="text-xs"> uzs</span>
                            </div>
                            <span class="text-xs"> {{item.start}}</span>
                        </p>
                    </div>


                </div>


            </div>
            <div style="width: 100%; padding: 10px 30px;">
                <h5 class="font-medium">{{getName('TotalSum')}}: {{counterStore.formatNumber(Sum)}} </h5>
            </div>


        </div>
    </div>

</template>
<script>

import {useConterStore} from "@/store/counter.js";

    export default {
        setup(){
            const counterStore = useConterStore();
            return {counterStore}
        },

        methods: {
            getName(val){
                return useConterStore().getName(val)
            },
            async getItems(){
                this.ItemModels = [];
                const response = await treatmentAddServiceAll(this.$route.query.treatment_id);
                console.log('Response:', response );
                this.ItemModels =  response.data.items;

                this.ItemModels.forEach((e)=>{
                    this.Services.push({
                        id: e.id,
                        count: e.count,
                    })
                })

                if (this.ItemModels.length > 0){
                    this.$emit('getModels', this.ItemModels)
                }
            },
            async sendResponse(){
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
                                count: model.count > 0 ? model.count : 1,
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
                        const response = await treatmentAddService(data);
                        console.log('Respone:', response)
                        if (response.status){
                            this.$router.push({ path: '/treatmetns/treatmetn', query:{ id: this.$route.query.id, treatment_id: this.$route.query.treatment_id } })
                        }else {
                            this.errorObj = response.data;
                        }
                    }

                }



            },
            hasKey(key) {
                return key in this.errorObj;
            },


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
            removeItem(id){
                this.Services = this.Services.filter(service => service.id != id);
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
            }

        },
        data(){
            return{
                Services: [],
                ItemModels: [],
                errorObj: []
            }
        },
        props:{
            Items:{
                type: [Array, Object],
                default: []
            },
            Id:{
                type: Number,
                default: 0
            },
            Sum:{
                type: Number,
                default: 0
            }
        },
        mounted() {
            // this.getItems()
        }


    }

</script>

<style scoped>
    .item_box{
        position: relative;
        width: 100%;
    }
    .delete_icon{
        position: absolute;
        top: 10px;
        right: 10px;
    }
</style>
