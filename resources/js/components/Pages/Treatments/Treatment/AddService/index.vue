<template>
    <Page :Animation = "false">
        <ServicesTable
            :Services = "Services"
            :Items = "Items"
            @pushArray = "pushArray($event)"
        />


       <RightTable :Id="Id" :Items = "Items" @sendId = "pushArray($event)" @getModels = "$event.length > 0 ? Items = $event : '' "  />
    </Page>
</template>

<script >
import Page from "@/components/Layout/Page.vue";
import ServicesTable from "./ServicesTable/Table.vue";
import Chat01 from "@/ui-components/Element/chat-01.vue";
import RightTable from "./Table/RightTable.vue";
import {treatment_service_categorys} from "@/Api.js";

    export default {
        components:{RightTable, Chat01, ServicesTable, Page},
        data(){
            return{
                Items: [],
                Services: [],
                Id: 0,
            }

        },
        methods:{

            getName(val){
                return useConterStore().getName(val)
            },


            async getItems(){
                const response = await treatment_service_categorys(this.$route.query.treatment_id);
                console.log('Keldi', response)
                this.Services = response.data.items;

            },

            pushArray(val){
                let isArray = false;
                this.Items.forEach((e) =>{
                    if (e.id == val.id){
                        isArray = true;
                    }
                });

                if (isArray){
                    this.Items = this.Items.filter(item => item.id != val.id);
                }else{
                    this.Items.push(val);
                }
                this.Id = val.id;

            },


        },

        mounted() {
            this.getItems()
        }
    }
</script>
