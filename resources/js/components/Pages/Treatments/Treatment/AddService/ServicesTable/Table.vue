<template >

    <div class="col-span-12 xl:col-span-8 ">


            <div
                class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">

                <span v-for="(item, index) in Services" >

                      <h4  v-if="item.services != 0" class="mb-6 mt-6 text-xl font-bold text-black dark:text-white">
                       {{index+1}}. {{item.name}}
                </h4>

                     <div class="flex flex-col table_media_box">

                    <div v-for="(item) in item.services" :class="item.max_count == 0 ? 'bg-danger' : '' " class="grid grid-cols-3 border-b  border-stroke dark:border-strokedark sm:grid-cols-3  ">

                        <div class="flex items-center gap-3 p-2.5 xl:p-5" >
                            <p class="font-bold  text-black dark:text-white sm:block ">
                                <Checkbox01

                                    @click = "sendData(item, item.max_count)"
                                    :Title = 'item.name'
                                    :onCheck = "searchKey(item.id, item.max_count)"
                                />

                            </p>
                        </div>


                        <div class="flex items-center justify-center p-2.5 xl:p-5">
                            <p class="font-medium  text-black dark:text-white">{{counterStore.formatNumber(item.service_total_sum)}} UZS</p>
                        </div>

                        <div class="flex items-center justify-center p-2.5 xl:p-5">
                            <p class="font-medium text-black dark:text-white">
                                {{item.max_count == 1000  ? '' : item.max_count }} {{ item.max_count == 1000 ? getName('NotLimited') : getName('Piece') }}
                            </p>
                        </div>

                    </div>

                </div>

                </span>



            </div>

        </div>

</template>
<script >
import {service_categorys} from "@/Api.js";
import {useConterStore} from "@/store/counter.js";
import Checkbox from "@/components/Pages/Diseases/EditPassword/Inputs/Checkbox.vue";
import Checkbox01 from "@/ui-components/Form/Checkbox/Checkbox01.vue";
import Counter from "@/components/Pages/Treatments/Treatment/AddService/Counter.vue";
import {getName} from "../../../../../../Config.js";
import {Alert} from "../../../../../../Config.js";
export default {
    setup(){
        const counterStore = useConterStore();
        return{counterStore}
    },
    components: {Counter, Checkbox01, Checkbox},
    props:{
        Services:{
            type: [Array, Object],
            default: []
        },
        Items:{
            type: [Array, Object],
            default: []
        },

    },
    methods:{
        sendData(item, count){

            if (Number(count) == 0){
                Alert('error', this.getName('ProductNot'));
                return false;
            }else {
                this.$emit('pushArray', item)
            }
        },
        searchKey(id, count){
            if (count == 0){
                return false;
            }
            let isArray = false;
            this.Items.forEach((e) =>{
                if (e.id == id){
                    isArray = true;
                }
            });
            return isArray;
        },
        getName(val){
            return useConterStore().getName(val)
        },

    }


}
</script>
