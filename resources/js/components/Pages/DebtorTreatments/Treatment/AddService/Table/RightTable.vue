<template>

    <div
        class="col-span-12 rounded-sm border border-stroke bg-white py-6 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-4">
        <h4 class="mb-6 px-7.5 text-xl font-bold text-black dark:text-white">
            {{getName('services')}}
        </h4>

        <div>

            <div
                v-for="item in Items"
               class="flex items-center gap-5 py-3 px-7.5 hover:bg-gray-3 dark:hover:bg-meta-4">

                <div class="flex flex-1 items-center justify-between">

                    <div class="item_box">
                        <h5 class="font-medium">{{item.name}}</h5>
                        <p>
                            <span class="text-sm font-medium">{{item.service_total_sum}}</span>
                            <span class="text-xs"> uzs</span>
                        </p>
                    </div>

                    <Input
                        style="width: 200px; margin-right:  20px;"
                        Type="number"
                        Label = ""
                        @onInput = "addCount($event, item)"
                        :Value = "searchKey(item.id)"
                        :isError = "hasKey(item.id)"
                        :message = "errorObj[item.id]"
                    />


                    <i @click = "this.$emit('sendId', item ), removeItem(item.id)" class="fa-solid  text-danger fa-trash setting-icon cursor-pointer"></i>

                </div>

            </div>

            <div class="w-full flex justify-content-end" style="justify-content: flex-end">
                <PrimaryButton2 @click = "sendResponse()" v-if="Items.length != 0" style="width: 200px; transform: scale(0.8)" :Title="getName('Save')" />
            </div>


        </div>
    </div>

</template>
<script>

    import Counter from "@/components/Pages/Treatments/Treatment/AddService/Counter.vue";
    import {Alert, getName} from "../../../../../../Config.js";
    import {useConterStore} from "@/store/counter.js";
    import PrimaryButton2 from "@/ui-components/Form/PrimaryButton2.vue";
    import Input from "@/components/Pages/Diseases/EditPassword/Inputs/Input.vue";
    import {treatmentAddService} from "@/Api.js";
    import {treatmentAddServiceAll} from "@/Api.js";

    export default {

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


            addCount(val, item){
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
        components: {Input, PrimaryButton2, Counter},
        props:{
            Items:{
                type: [Array, Object],
                default: []
            },
            Id:{
                type: Number,
                default: 0
            }
        },
        mounted() {
            this.getItems()
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
