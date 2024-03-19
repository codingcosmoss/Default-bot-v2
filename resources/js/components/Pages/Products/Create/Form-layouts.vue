<template>


    <!-- Breadcrumb Start -->
    <div style="justify-content: flex-end;" class="mb-6 flex  flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

        <nav >
            <ol class="flex items-center gap-2">
                <li><a class="font-medium cursor-pointer" @click = "this.$router.push('/products')">
                    {{getName('Products')}} /</a></li>
                <li  class=" font-medium text-primary">{{getName('create')}}</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <!-- ====== Form Layout Section Start -->
    <div class="grid grid-cols-1 gap-9 sm:grid-cols-2">
        <div class="flex flex-col gap-9">
            <!-- Contact Form -->

            <div
                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                    <h3 class="font-semibold text-black dark:text-white">
                        {{getName('Products')}}
                    </h3>
                </div>
                <form action="#">
                    <div class="p-6.5">

                        <Input
                            :Label = "getName('name_content')"
                            @onInput = "ProductName = $event"
                            :isError = "hasKey('name')"
                            :message = "errorObj['name']"
                            :Value = "ProductName"
                        />

                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">

                            <Input
                                :Couple = "false"
                                :Label = "getName('Bar_code')"
                                @onInput = "BarCode = $event"
                                :isError = "hasKey('bar_code')"
                                :message = "errorObj['bar_code']"
                                :Value = "BarCode"
                            />

                            <Input
                                :Couple = "false"
                                :Label = "getName('WendorCode')"
                                @onInput = "WendorCode = $event"
                                :isError = "hasKey('wendor_code')"
                                :message = "errorObj['wendor_code']"
                                :Value = "WendorCode"
                            />




                        </div>


                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">

                            <Input
                                :Couple = "false"
                                :Label = "getName('price')"
                                @onInput = "Price = $event"
                                :isError = "hasKey('price')"
                                :message = "errorObj['price']"
                                :Value = "Price"
                                Type = "number"
                            />

                            <Select
                                :Couple="false"
                                :Label="getName('Group')"
                                @onSelect="this.GroupID = $event"
                                :isError="hasKey('group_id')"
                                :message="errorObj['group_id']"
                            >
                                <option>---</option>
                                <option
                                    v-for="group in Groups"
                                    :value="group.id"
                                    :selected="group.id == GroupID"
                                >
                                    {{ group.name }}
                                </option>
                            </Select>

                        </div>





                    </div>
                </form>
            </div>
        </div>

        <div class="flex flex-col gap-9">
            <!-- Sign In Form -->
            <div
                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                    <h3 class="font-semibold text-black dark:text-white">

                    </h3>
                </div>

                <div class=" flex flex-col gap-6 xl:flex-row p-6.5" >
                    <Select
                        :Couple="false"
                        :Label="getName('SizeType')"
                        @onSelect="this.SizeType = $event"
                        :isError="hasKey('size_type')"
                        :message="errorObj['size_type']"
                    >
                        <option>---</option>
                        <option
                            value="piece"
                            :selected="SizeType == 'piece' "
                        >
                            {{ getName('Piece') }}
                        </option>

                        <option
                            value="l"
                            :selected="SizeType == 'l' "
                        >
                            {{ getName('Liter') }} / (l)
                        </option>
                        <option
                            value="kg"
                            :selected="SizeType == 'kg' "
                        >
                            {{ getName('Kilogram') }} / (kg)
                        </option>
                        <option
                            value="g"
                            :selected="SizeType == 'g' "
                        >
                            {{ getName('Gram') }} / (g)
                        </option>

                    </Select>

                    <Input
                        :Couple = "false"
                        :Label = "getName('MinSize')"
                        @onInput = "MinAmount = $event"
                        :isError = "hasKey('min_amount')"
                        :message = "errorObj['min_amount']"
                        :Value = "MinAmount"
                        Type = "number"
                    />



                </div>

                <div class=" pl-7 p-6.5">

                    <button @click="create" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">
                        {{getName('create')}}
                    </button>
                </div>

            </div>


        </div>
    </div>
    <!-- ====== Form Layout Section End -->

</template>
<script >
import Input from "./Inputs/Input.vue";
import {useConterStore} from "../../../../store/counter.js";
import Checkbox from "./Inputs/Checkbox.vue";
import InputColor from "./Inputs/InputColor.vue";
import {productCreate, groups } from "../../../../Api.js";
import {GET} from "../../../../Config.js"
import {Alert} from "../../../../Config.js";
import PrimaryButton from "../../../../ui-components/Form/PrimaryButton.vue";
import PrimaryButton2 from "../../../../ui-components/Form/PrimaryButton2.vue";
import Select from "./Inputs/Select.vue";
import MultiSelect from '../../../../ui-components/Form/MultiSelect.vue'
import Checkbox01 from "../../../../ui-components/Form/Checkbox/Checkbox01.vue";
import checkbox01 from "../../../../ui-components/Form/Checkbox/Checkbox01.vue";

export default {
    computed: {
        checkbox01() {
            return checkbox01
        }
    },
        data(){
            return{
                name: '',
                order: '',
                code: '',
                price: '',
                category: '',
                material_price: '',
                technic_price: '',
                status: 1,
                isLoginError: false,
                errorObj: {},
                Groups: [],
                Checkbox: '',
                // input varables
                ProductName: '',
                WendorCode: '',
                BarCode: '',
                Price: 0,
                GroupID: 0,
                SizeType: '',
                MinAmount: 0,


            }
        },
        components:{Checkbox01, Select, PrimaryButton2,MultiSelect, PrimaryButton, InputColor, Checkbox, Input},
        methods:{

            getName(val){
                return useConterStore().getName(val)
            },
            async getGroups(){
                const response = await groups(1, 1000);
                this.Groups = response.data.items;
            },


            async create(){

                var data = {
                    'name': this.ProductName,
                    'price': this.Price,
                    'bar_code': this.BarCode,
                    'vendor_code': this.WendorCode,
                    'group_id': this.GroupID,
                    'size_type': this.SizeType,
                    'min_amount': this.MinAmount,
                }
                const response = await productCreate(data);
                console.log(response)
                if (response.status){
                    Alert('success', 'Created successfully !')
                    this.$router.push('/products')
                }else {
                    this.errorObj = response.data;
                }


            },

            hasKey(key) {
                return key in this.errorObj;
            },


            onSelect(val){

                if (this.diseasesIds.indexOf(val) == -1){
                    this.diseasesIds.push({
                        'name': this.allDiseases.filter(item => item.id == Number(val))[0]['name'],
                        'id': this.allDiseases.filter(item => item.id == Number(val))[0]['id'],
                    });
                    this.allDiseases = this.allDiseases.filter(item => item.id != Number(val))
                }

            },
            onPush(val){
                this.allDiseases.push(val);
                this.diseasesIds = this.diseasesIds.filter(item => item['id'] != val.id);
            },


        },
        mounted() {
            this.getGroups()
        }
}
</script>


<style>
    .genderCheckbox{
        display: flex;
        align-items: flex-end;
    }

    .list01{
        padding: 5px 27px;
        display: flex;
        align-content: space-between;
        justify-content: space-between;
        flex-direction: column;
    }
    .btn{
        width: 60px;
        transform: scale(0.8);
    }

    .btn2{
        margin: 20px 0;
        margin-top: 30px;
        margin-left: 10px;
        width: 60px;
        transform: scale(0.8);
    }
    .btn2 button{
        background: rgba(255, 0, 0, 0.8);
    }


</style>
