<template>


    <!-- ====== Form Layout Section Start -->
    <div class="grid grid-cols-1 gap-9 sm:grid-cols-2">
        <div class="flex flex-col gap-9">
            <!-- Contact Form -->
            <div
                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                    <h3 class="font-semibold text-black dark:text-white">
                        {{getName('Profile')}}
                    </h3>
                </div>
                <form action="#">
                    <div class="p-6.5">

                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">


                            <ImageInput
                                Label = " "
                                @image = "logo = $event"
                                :Photo = "logo"
                            />


                        </div>


                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">


                            <Input
                                :Couple = "false"
                                :Label = "getName('name_content')"
                                @onInput = "name = $event"
                                :isError = "hasKey('name')"
                                :message = "errorObj['name']"
                                :Value = "name"
                            />

                            <Input
                                :Couple = "false"
                                :Label = "getName('phone')+ ' 1'"
                                @onInput = "phone1 = $event"
                                :isError = "hasKey('phone1')"
                                :message = "errorObj['phone1']"
                                :Value = "phone1"
                            />

                        </div>


                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">

                            <Input
                                :Couple = "false"
                                :Label = "getName('phone') + ' 2'"
                                @onInput = "phone2 = $event"
                                :isError = "hasKey('phone2')"
                                :message = "errorObj['phone2']"
                                :Value = "phone2"
                            />

                            <Input
                                :Couple = "false"
                                :Label = "getName('Email')"
                                @onInput = "email = $event"
                                :isError = "hasKey('email')"
                                :message = "errorObj['email']"
                                :Value = "email"
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

                        </div>

                    </div>
                    <div class=" pl-7 p-6.5">

                        <button @click="companySetting()" type="button" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">
                            {{getName('Save')}}
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>


<!--    Alert-->






</template>
<script >

import {useConterStore} from "@/store/counter.js";
import Input from "@/components/Pages/Diseases/EditPassword/Inputs/Input.vue";
import ImageInput from "@/components/Pages/Employees/Update/Inputs/ImageInput.vue";
import {companySettingStore} from "@/Api.js";
import {getCompany} from "@/Api.js";
import {Alert} from "../../../Config.js";


export default {

    data(){
        return{
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
            name: '',
            phone1: '',
            phone2: '',
            email: '',
            address: '',
            printer_size: '',
            bot_token: '',
            logo: 'https://avatars.mds.yandex.net/i?id=094af778330da89e3409830578322fe37146a733-10963969-images-thumbs&n=13',

        }
    },
    components:{ImageInput, Input},
    methods:{

        getName(val){
            return useConterStore().getName(val)
        },

        async companySetting(){

            var data = {
                'name': this.name,
                'phone1': this.phone1,
                'phone2': this.phone2,
                'email': this.email,
                'address': this.address,
                'image': this.logo,
                'bot_token': this.bot_token,
                'printer_size': this.printer_size,
            }
            const response = await companySettingStore(data);
            if (response.status){
                this.getCompany();
                Alert('success', 'Saved successfully !')
            }else {
                Alert('error', 'Error !')
                this.errorObj = response.data;
            }

        },
        async getCompany(){

            const response = await getCompany();
            let data = response.data.items;
            this.name = data.name;
            this.phone1 = data.phone1;
            this.phone2 = data.phone2;
            this.email = data.email;
            this.address = data.address;
            this.printer_size = data.printer_size;
            this.bot_token = data.bot_token;
            this.logo = data.logo[0]['url'];

        },

        hasKey(key) {
            return key in this.errorObj;
        },


    },
    mounted() {
        this.getCompany()
    }
}
</script>


<style scoped>
.genderCheckbox{
    display: flex;
    align-items: flex-end;
}
.Alert_div{
    width: 300px;
    height: 100px;
    background: #17e30d;
    position: sticky;
    right: 10px;
    top: 10px ;
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

.alert {
    width: 500px !important;
    background: #17e30d;
    color: white;
    position: relative;
    left: 0;
    width: auto;
    height: auto;
    padding: 10px;
    margin: 10px;
    line-height: 1.8;
    border-radius: 5px;
    cursor: hand;
    cursor: pointer;
    font-family: sans-serif;
    font-weight: 400;
}

.alertCheckbox {
    display: none;
}

:checked + .alert {
    display: none;
}

.alertText {
    display: table;
    margin: 0 auto;
    text-align: center;
    font-size: 16px;
}

.alertClose {
    float: right;
    padding-top: 5px;
    font-size: 10px;
}

.clear {
    clear: both;
}

.info {
    background-color: #EEE;
    border: 1px solid #DDD;
    color: #999;
}

.success {
    background-color: #EFE;
    border: 1px solid #DED;
    color: #9A9;
}

.notice {
    background-color: #EFF;
    border: 1px solid #DEE;
    color: #9AA;
}

.warning {
    background-color: #FDF7DF;
    border: 1px solid #FEEC6F;
    color: #C9971C;
}

.error {
    background-color: #FEE;
    border: 1px solid #EDD;
    color: #A66;
}


</style>
