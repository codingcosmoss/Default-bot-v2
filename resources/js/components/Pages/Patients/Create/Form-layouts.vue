<template>


    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

        <nav>
            <ol class="flex items-center gap-2">
                <li><a class="font-medium cursor-pointer" @click = "this.$router.push('/patients')">
                    {{getName('Patients')}} /</a></li>
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
                        {{getName('Patients')}}
                    </h3>
                </div>
                <form action="#">
                    <div class="p-6.5">


                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">


                            <Input
                                :Couple = "false"
                                :Label = "getName('last_name')"
                                @onInput = "last_name = $event"
                                :isError = "hasKey('last_name')"
                                :message = "errorObj['last_name']"
                                :Value = "last_name"
                            />

                            <Input
                                :Couple = "false"
                                :Label = "getName('first_name')"
                                @onInput = "first_name = $event"
                                :isError = "hasKey('first_name')"
                                :message = "errorObj['first_name']"
                                :Value = "first_name"
                            />

                        </div>


                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">

                            <Input
                                :Couple = "false"
                                :Label = "getName('phone')"
                                @onInput = "phone = $event"
                                :isError = "hasKey('phone')"
                                :message = "errorObj['phone']"
                                :Value = "phone"
                            />

                            <Input
                                :Couple = "false"
                                :Label = "getName('Job')"
                                @onInput = "job = $event"
                                :isError = "hasKey('job')"
                                :message = "errorObj['job']"
                                :Value = "job"
                            />

                        </div>

                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">

                            <Input
                                :Couple = "false"

                                :Label = "getName('Address')"
                                @onInput = "address = $event"
                                :isError = "hasKey('address')"
                                :message = "errorObj['address']"
                                :Value = "address"
                            />
                            <Input
                                :Couple = "false"

                                :Label = "getName('Gender')"
                                @onInput = "gender = $event"
                                :isError = "hasKey('gender')"
                                :message = "errorObj['gender']"
                                :Value = "gender"
                            />

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
                    <Input
                        :Couple = "false"
                        :Label = "getName('Date_birth')"
                        @onInput = "birthday = $event"
                        :isError = "hasKey('birthday')"
                        :message = "errorObj['birthday']"
                        :Value = "birthday"
                    />

                    <Input
                        :Couple = "false"
                        :Label = "getName('Serial_number')"
                        @onInput = "sort_order = $event"
                        :isError = "hasKey('sort_order')"
                        :message = "errorObj['sort_order']"
                        :Value = "sort_order"
                        Type = "number"
                    />



                </div>

                <div class="flex flex-col gap-6 xl:flex-row  px-6.5"    >


                    <MultiSelect
                        :Couple = "false"
                        :Label = "getName('diseases')"
                        @onInput = "sort_order = $event"
                        :isError = "hasKey('sort_order')"
                        :message = "errorObj['sort_order']"
                        :Value = "sort_order"
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
import {serviceCreate, Employees, service_categorys} from "../../../../Api.js";
import {GET} from "../../../../Config.js"
import {Alert} from "../../../../Config.js";
import PrimaryButton from "../../../../ui-components/Form/PrimaryButton.vue";
import PrimaryButton2 from "../../../../ui-components/Form/PrimaryButton2.vue";
import Select from "./Inputs/Select.vue";
import MultiSelect from '../../../../ui-components/Form/MultiSelect.vue'

export default {
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
                categories: [],

                // input varables
                last_name: '',
                first_name: '',
                phone: '',
                job: '',
                address: '',
                gender: '',
                birthday: '',
                sort_order: '',
                diseasesIds : [],
                diseases : [],


            }
        },
        components:{Select, PrimaryButton2,MultiSelect, PrimaryButton, InputColor, Checkbox, Input},
        methods:{
            getName(val){
                return useConterStore().getName(val)
            },

            async getCategories(){
                const response = await service_categorys(null, 1000);
                this.categories = response.data.items
            },

            async create(){
                var data = {
                    'name': this.name,
                    'order': this.order,
                    'code': this.code,
                    'price': this.price,
                    'category_id': this.category,
                    'material_price': this.material_price,
                    'technic_price': this.technic_price,
                    'status': this.status,
                    'color': this.color,
                    'personal_procents': this.personal_procents
                }
                const response = await serviceCreate(data);

                if (response.status){
                    Alert('success', 'Created successfully !')
                    this.$router.push('/services')
                }else {
                    this.errorObj = response.data;
                }


            },

            hasKey(key) {
                return key in this.errorObj;
            },

        },
        mounted() {
            this.getCategories()
        }
}
</script>


<style>

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
