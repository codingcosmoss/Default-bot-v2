<template>


    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row  sm:items-center sm:justify-between">

        <nav>
            <ol class="flex items-center gap-2">
                <li><a class="font-medium cursor-pointer" @click = "this.$router.push('/employees')"> {{getName('employees')}} /</a></li>
                <li  class=" font-medium text-primary">{{getName('edit_password')}}</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <!-- ====== Form Layout Section Start -->
    <div style="width: 500px; margin: 0 auto" class="box-01 flex flex-col gap-9">
        <!-- Contact Form -->

        <div
            class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                <h3 class="font-semibold text-black dark:text-white">
                    {{getName('edit_password')}}
                </h3>
            </div>
            <form action="#" >
                <div class="p-6.5">

                    <Input
                        :Label = "getName('password')"
                        @onInput = "password = $event"
                        Type = "password"
                        :isError = "hasKey('password')"
                        :message = "errorObj['password']"
                    />
                    <Input
                        :Label = "getName('reset_password')"
                        @onInput = "testPassword($event)"
                        :isError = "isPasswordError"
                        Type = "password"
                        :Value = "reset_password"
                        message = "The password is not the same"
                    />


                    <div class=" pl-7 p-6.5">
                        <button type="button" @click="create" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">
                            Submit
                        </button>
                    </div>




                </div>
            </form>
        </div>
    </div>
    <!-- ====== Form Layout Section End -->

</template>
<script >
import Input from "./Inputs/Input.vue";
import {useConterStore} from "../../../../store/counter.js";
import Checkbox from "./Inputs/Checkbox.vue";
import InputColor from "./Inputs/InputColor.vue";
import ImageInput from "../Update/Inputs/ImageInput.vue";
import {Alert} from "../../../../Config.js";
import {updatePassword} from "../../../../Api.js";

export default {
        data(){
            return{

                password: '',
                isPasswordError: false,
                reset_password: '',
                isLoginError: false,
                color: '#FFFFFF',
                errorObj: {},
            }
        },
        components:{ImageInput, InputColor, Checkbox, Input},
        methods:{
            getName(val){
                return useConterStore().getName(val)
            },
            testPassword(val){
                if (this.password != val || this.password == ''){
                    this.isPasswordError = true;
                }else {
                    this.isPasswordError = false;
                }
                this.reset_password = val;
                return this.isPasswordError;

            },
            async create(){
                if (this.testPassword(this.reset_password) != true){
                    var data = {
                        'id': this.$route.query.id,
                        'password': this.password,
                    }
                    const response = await updatePassword(data);
                    if (response.status){
                        Alert('success', 'Update successfully !')
                        this.$router.push('/employees')
                    }else {
                        console.log(response.data)
                        this.errorObj = response.data;
                    }
                }


            },

            hasKey(key) {
                return key in this.errorObj;
            }

}
    }
</script>


<style>

    .list01{
        padding: 5px 27px;
        display: flex;
        justify-content: space-between;
    }
    .box-01{
        animation: box-01 .5s linear alternate;
    }
    @keyframes box-01 {
        from{
            transform: scale(.7);
        }to{
        transform: scale(1);
                 }
    }

</style>
