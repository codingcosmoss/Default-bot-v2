<template>


    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between" style="display: flex; justify-content: flex-end">

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

                        <ImageInput
                            @image = "Image = $event"
                            Label = "Photo"
                            :Photo = "Photo"

                        />






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

                <div class=" flex flex-col gap-6 xl:flex-row px-6.5  mt-6.5">


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
                        :Label = "getName('name')"
                        @onInput = "first_name = $event"
                        :isError = "hasKey('first_name')"
                        :message = "errorObj['first_name']"
                        :Value = "first_name"
                    />

                </div>
                <div class=" flex flex-col gap-6 xl:flex-row px-6.5  mt-6.5">

                    <Input
                        :Couple = "false"

                        :Label = "getName('Address')"
                        @onInput = "address = $event"
                        :isError = "hasKey('address')"
                        :message = "errorObj['address']"
                        :Value = "address"
                    />

                    <label class="mb-2.5 block text-black dark:text-white">
                        {{getName('Gender')}}
                    </label>

                    <checkbox01
                        @click = "Checkbox = 5, console.log(Checkbox) "
                        :onCheck = "Checkbox == 5 ? true : false"
                        :Title = "getName('Male')"
                        Class = "genderCheckbox"
                    />

                    <checkbox01
                        @click = "Checkbox = 4, console.log(Checkbox)"
                        :onCheck = "Checkbox == 4 ? true : false"
                        :Title = "getName('Woman')"
                        Class = "genderCheckbox"
                    />



                </div>
                <p v-if="hasKey('gender')" style="float: right" class="text-danger">{{errorObj['gender']}}</p>

                <!--                class="mb-4.5 flex flex-col gap-6 xl:flex-row"-->
                <div class="  flex flex-col gap-6 xl:flex-row px-6.5  mt-6.5  " >

                    <Input
                        :Couple = "false"
                        :Label = "getName('phone')"
                        @onInput = "formatPhone($event)"
                        :isError = "hasKey('phone')"
                        :message = "errorObj['phone']"
                        :Value = "phone"
                        Class ="phone_input"
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

                <div class=" flex flex-col gap-6 xl:flex-row p-6.5" >
                    <Input
                        :Couple = "false"
                        :Label = "getName('Date_birth')"
                        @onInput = "birthday = $event"
                        :isError = "hasKey('birthday')"
                        :message = "errorObj['birthday']"
                        :Value = "birthday"
                        Type = "date"
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

                <div class="flex flex-col gap-6 xl:flex-row  px-6.5" >


                    <MultiSelect
                        :Couple = "false"
                        :Label = "getName('diseases')"
                        @onSelect = "onSelect($event)"
                        :Items = "diseasesIds"
                        @pushArray = "onPush($event)"
                    >
                        <option selected >---</option>
                        <option v-for="item in allDiseases" :value="item['id']" >{{item['name']}}</option>

                    </MultiSelect>


                    <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">


                        <!--                            <Input-->
                        <!--                                :Couple = "false"-->

                        <!--                                :Label = "getName('Gender')"-->
                        <!--                                @onInput = "gender = $event"-->
                        <!--                                :isError = "hasKey('gender')"-->
                        <!--                                :message = "errorObj['gender']"-->
                        <!--                                :Value = "gender"-->
                        <!--                            />-->

                    </div>


                </div>




                <div class=" pl-7 p-6.5" style="display: flex; justify-content: center">

                    <loader-spinning v-if="Loader" style="margin: 0 auto; " />
                    <button v-if="!Loader" @click="update" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">
                        {{getName('update')}}
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
import {patientUpdate, getDiseases, patientShow,patientCreate} from "../../../../Api.js";
import {GET} from "../../../../Config.js"
import {Alert} from "../../../../Config.js";
import PrimaryButton from "../../../../ui-components/Form/PrimaryButton.vue";
import PrimaryButton2 from "../../../../ui-components/Form/PrimaryButton2.vue";
import Select from "./Inputs/Select.vue";
import MultiSelect from '../../../../ui-components/Form/MultiSelect.vue'
import Checkbox01 from "../../../../ui-components/Form/Checkbox/Checkbox01.vue";
import checkbox01 from "../../../../ui-components/Form/Checkbox/Checkbox01.vue";
import ImageInput from "@/components/Pages/Employees/Update/Inputs/ImageInput.vue";

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
                categories: [],
                Checkbox: '',
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
                allDiseases : [],
                Image: '',
                Photo: '',
                Loader: false



            }
        },
        components:{
            ImageInput,
            Checkbox01, Select, PrimaryButton2,MultiSelect, PrimaryButton, InputColor, Checkbox, Input},
        methods:{

            getName(val){
                return useConterStore().getName(val)
            },
            formatPhone(phoneNumberString) {
                const arr = ['0','1','2','3','4','5','6','7','8','9','', ' '];
                const input = document.querySelector('.phone_input');
                let phone = 0;
                let next = this.phone.length < phoneNumberString.length ? true : false;
                console.log(phoneNumberString, phoneNumberString.length)
                if (next){
                    if (!arr.includes(phoneNumberString.slice(phoneNumberString.length-1,phoneNumberString.length ))){
                        input.value = this.phone;
                        return false;
                    }else if(phoneNumberString.length > 19){
                        input.value = this.phone;
                        return false;
                    }
                }else {
                    if(phoneNumberString.length > 20){
                        input.value = this.phone;
                        return false;
                    }
                }

                if (phoneNumberString.length == 4 && next){
                    this.phone = '(+' + phoneNumberString + ') ';
                }else if (phoneNumberString.length == 9 && next){
                    this.phone = phoneNumberString + ' ';
                }else if (phoneNumberString.length == 13 && next){
                    this.phone = phoneNumberString + ' ';
                }else if ((phoneNumberString.length == 16 || phoneNumberString.length == 17) && next){
                    this.phone = phoneNumberString + ' ';
                }else {
                    this.phone = phoneNumberString;
                }
                // this.phone = phoneNumberString;
                // return true;
            },


            async update(){
                this.Loader = true;

                var ids = [];
                if (this.diseasesIds.length > 0){
                    this.diseasesIds.forEach((e) => {
                        ids.push(e['id']);
                    });
                }else {
                    ids = 0;
                }




                var data = {
                    'first_name': this.first_name,
                    'last_name': this.last_name,
                    'phone': this.phone,
                    'job': this.job,
                    'address': this.address,
                    'gender': this.Checkbox,
                    'birthday': this.birthday,
                    'sort_order': this.sort_order,
                    'diseasesIds': ids,
                    'price' : 0,
                    'image': this.Image
                }

                const response = await patientUpdate(this.$route.query.id ,data);
                console.log(response)
                if (response.status){
                    Alert('success', 'Update successfully !')
                    this.$router.push('/patients')
                }else {
                    this.errorObj = response.data;
                    this.Loader = false;
                }


            },
            async getModel(){

                const response = await patientShow(this.$route.query.id);

                if (response.status){
                    this.first_name = response.data.first_name;
                    this.last_name = response.data.last_name;
                    this.phone = response.data.phone;
                    this.job = response.data.job;
                    this.address = response.data.address;
                    this.Checkbox = response.data.gender;
                    this.birthday = response.data.birthday;
                    this.sort_order = response.data.sort_order;
                    this.diseasesIds = response.data.diseases;
                    this.Photo =  response.data.image[0].url;
                    this.getDisiases();

                }


            },
            async getDisiases(){
                const response = await getDiseases(null, 1000);
                var arr = [];
                response.data.items.forEach((item) => {
                        if (!this.diseasesIds.some(model => model.id == item.id)) {
                            arr.push({
                            name: item.name,
                            id: item.id
                        })
                    }

                });
                this.allDiseases = arr;
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
            hasPermission(){
                let permissions = localStorage.getItem('permissions').split(',');
                if (permissions.includes('Patients-update')){
                    return true;
                }else {
                    this.$router.go(-1);
                }
            }

        },
        mounted() {
            this.getModel()
            this.hasPermission()
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
