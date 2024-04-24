<template>


    <!-- Breadcrumb Start -->
    <div class="breadcrumb-nav mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

        <nav>
            <ol class="flex items-center gap-2">
                <li><a class="font-medium cursor-pointer" @click = "this.$router.push('/employees')"> {{getName('employees')}} /</a></li>
                <li  class=" font-medium text-primary">{{getName('create')}}</li>
            </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

    <!-- ====== Form Layout Section Start -->
    <div  class="grid grid-cols-1 gap-9 sm:grid-cols-2">
        <div class="flex flex-col gap-9">
            <!-- Contact Form -->

            <div
                class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
                    <h3 class="font-semibold text-black dark:text-white">
                        {{getName('add_employee')}}
                    </h3>
                </div>
                <form action="#">
                    <div class="p-6.5">
                        <ImageInput
                            @image = "image = $event"
                        />

                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">

                            <Input
                                :Couple = "false"
                                :Label = "getName('employee_name')"
                                @onInput = "name = $event"
                                :isError = "hasKey('name')"
                                :message = "errorObj['name']"
                            />
                            <Input
                                :Couple = "false"
                                :Label = "getName('Position_employee')"
                                @onInput = "position = $event"
                                :isError = "hasKey('position')"
                                :message = "errorObj['position']"
                            />

                        </div>


                        <Input
                            :Label = "getName('login')"
                            @onInput = "testLogin($event)"
                            :Value = "login"
                            :isError = "isLoginError || errorObj['login']"
                            :message = " errorObj['login'] ?  errorObj['login'] : 'Login is available !' "

                        />

                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                            <Input
                                :Couple = "false"
                                :Label = "getName('password')"
                                @onInput = "password = $event"
                                Type = "password"
                                :isError = "hasKey('password')"
                                :message = "errorObj['password']"
                            />
                            <Input
                                :Couple = "false"
                                :Label = "getName('reset_password')"
                                @onInput = "testPassword($event)"
                                :isError = "isPasswordError"
                                Type = "password"
                                :Value = "reset_password"
                                message = "The password is not the same"
                            />

                        </div>

                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">

                            <InputColor
                                Type = "color"
                                :Couple = "false"
                                :Label = "getName('color')"
                                @onInput = "color = $event"
                                :isError = "hasKey('color')"
                                :message = "errorObj['color']"
                            />
                            <Input
                                Type = "number"
                                :Couple = "false"
                                :Label = "getName('Serial_number')"
                                @onInput = "sort_order = $event"
                                :isError = "hasKey('sort_order')"
                                :message = "errorObj['sort_order']"

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

                &nbsp;
                <p class="pt-0 p-6.5" > {{getName('employee_roles')}}:</p>
                <ul  style="padding: 5px 27px" >
                    <li>

                        <Checkbox01
                            @click = "addAllRoles()"
                            :onCheck = "Roles.length == 16 ? true : false"
                            :Title = "getName('allPermissions')"
                        />

                    </li>

                    &nbsp;&nbsp;
                    <li style="width: 100%">
                        <table class="table01" style="width: 100%">
                            <tr   v-for="role in Permissions" >

                                <td style="font-weight: bold; max-width: 120px">
                                    <Checkbox01
                                        @click = "addRoles(role['id'])"
                                        :onCheck = "Roles.includes(role['id'])"
                                        :Title = "getName(role['lang_name'])"
                                        Class = "genderCheckbox"
                                    />

                                </td>

                                <td  :class=" !Roles.includes(role['id']) ? 'td_hidden' : '' " >
                                    <Checkbox01
                                        v-for=" permission in role['permissions'] "
                                        style="margin: 5px 0"
                                        @click = "addPermission(role['id'],permission['id'] )"
                                        :onCheck = "hasPermission(role['id'],permission['id'])"
                                        :Title = "getName(permission['lang_name'])"
                                        Class = "genderCheckbox"
                                    />

                                </td>
                            </tr>
                        </table>
                    </li>

                </ul>


                <div class=" pl-7 p-6.5" style="display: flex; justify-content: center">
                    <loader-spinning v-if="Loader" style="margin: 0 auto; " />
                    <button v-if="!Loader" @click="sendData" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">
                        {{getName('create')}}
                    </button>
                </div>
            </div>




        </div>


    </div>


    <!-- ====== Form Layout Section End -->

</template>
<script >
import {testLogin} from "../../../../Api.js";
import Input from "./Inputs/Input.vue";
import {useConterStore} from "../../../../store/counter.js";
import Checkbox from "./Inputs/Checkbox.vue";
import InputColor from "./Inputs/InputColor.vue";
import {employeeCreate} from "../../../../Api.js";
import ImageInput from "../Update/Inputs/ImageInput.vue";
import {Alert} from "../../../../Config.js";
import Table from "@/components/Pages/Patients/Table.vue";
import Checkbox01 from "@/ui-components/Form/Checkbox/Checkbox01.vue";
import {permissions} from "../../../../Api.js";
import {releaseNextTicks} from "alpinejs/src/nextTick.js";
import {has} from "vue-modal-service";
export default {
        data(){
            return{
                name: '',
                position: '',
                login: '',
                password: '',
                profil_photo_path: '',
                percent_salary: '',
                salary_static: '',
                sort_order: '',
                isPasswordError: false,
                reset_password: '',
                isLoginError: false,
                color: '#FFFFFF',
                errorObj: {},
                image: '',
                Roles: [],
                Permissions: [],
                PermissionsArr: [],
                Loader: false

            }
        },
        components:{Checkbox01, Table, ImageInput, InputColor, Checkbox, Input},
        methods:{
            releaseNextTicks,
            getName(val){
                return useConterStore().getName(val)
            },
            async getPermissions(){
                const response = await permissions();
                this.Permissions = response.data
                console.log(response.data);
            },
            testPassword(val){
                if (this.password != val){
                    this.isPasswordError = true;
                }else {
                    this.isPasswordError = false;
                }
                this.reset_password = val;
                return this.isPasswordError;

            },
            addAllRoles(){
                if (this.Roles.length != 16){
                    this.Roles = [];
                    this.Permissions.forEach((e) => {
                        this.Roles.push(e.id);
                        console.log('Permission>',e.permissions)
                        e.permissions.forEach((permission) => {
                            this.PermissionsArr.push({
                                role_id: permission.role_id,
                                permission_id: permission.id,
                            });

                        })
                    })
                }else {
                    this.Roles = [];
                    this.PermissionsArr = [];
                }

            },

            addRoles(role){
                if(this.Roles.includes(role)){
                    this.Roles = this.Roles.filter((item) => item != role);
                    this.PermissionsArr = this.PermissionsArr.filter((e) => e.role_id != role);
                }else{
                    this.Roles.push(role);
                }
            },

            addPermission(role_id, permission_id){

                if (!this.hasPermission(role_id, permission_id)){
                    this.PermissionsArr.push({
                        role_id: role_id,
                        permission_id: permission_id,
                    })
                }else {
                    let arrs = [];
                    this.PermissionsArr = this.PermissionsArr.filter((e) => {
                        if (e.role_id == role_id && e.permission_id == permission_id){
                            return false;
                        }else {
                            return true;
                        }
                    })
                }


            },

            hasPermission(role_id, permission_id){
                let isRole = false;
                this.PermissionsArr.forEach((e)=>{
                    if (e.role_id == role_id && e.permission_id == permission_id){
                        isRole = true;
                    }
                })
                if (isRole){
                    return true;
                }
                return false;
            },

            async create(){
                this.Loader = true;
                if (this.testPassword(this.reset_password) != true ){
                    var data = {
                        'name': this.name,
                        'position': this.position,
                        'login': this.login,
                        'password': this.password,
                        'profil_photo_path': this.profil_photo_path,
                        'percent_salary': this.percent_salary,
                        'salary_static': this.salary_static,
                        'sort_order': this.sort_order,
                        'color': this.color,
                        'image': this.image,
                        'roles': this.Roles,
                        'permissions': this.PermissionsArr
                    }
                    const response = await employeeCreate(data);
                    if (response.status){
                        Alert('success', 'Created successfully !')
                        this.$router.push('/employees')
                    }else {
                        console.log(response.data)
                        this.errorObj = response.data;
                        this.Loader = false;
                    }
                    this.Loader = false;
                }


            },
            async testLogin(val){
                this.login = val;
                const response = await testLogin({
                    'login': val,
                    'id': 0
                });
                console.log('R:',response)
                if (response.status){
                    this.isLoginError = true;
                }else {
                    this.isLoginError = false;
                }
            },
            async sendData(){
                this.Loader = true;
                const val = this.login;
                const response = await testLogin({
                    'login': val,
                    'id': 0
                });
                if (response.status){
                    this.isLoginError = true;
                    this.Loader = false;
                }else {
                    this.isLoginError = false;
                    this.create();
                }
            },

            hasKey(key) {
                return key in this.errorObj;
            }
        },
    mounted() {
        this.getPermissions()
    }
}
</script>


<style>
    .td_hidden{
        opacity: 0.5;
        pointer-events: none;
    }


</style>
