<template>


    <!-- Breadcrumb Start -->
    <div class=" breadcrumb-nav mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between" >

        <nav>
            <ol class="flex items-center gap-2">
                <li><a class="font-medium cursor-pointer" @click = "this.$router.push('/')"> {{getName('Home')}} /</a></li>
                <li  class=" font-medium text-primary">{{getName('update')}}</li>
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
                        {{getName('add_employee')}}
                    </h3>
                </div>
                <form action="#">
                    <div class="p-6.5">

                        <ImageInput
                            @image = "image = $event"
                            :Photo = "photo"
                            Label = "Photo"
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


                <form action="#">
                    <div class="p-6.5">


                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                            <Input
                                :Couple = "false"
                                :Label = "getName('employee_name')"
                                @onInput = "name = $event"
                                :isError = "hasKey('name')"
                                :message = "errorObj['name']"
                                :Value = "name"
                            />
                            <Input
                                :Couple = "false"
                                :Label = "getName('Position_employee')"
                                @onInput = "position = $event"
                                :isError = "hasKey('position')"
                                :message = "errorObj['position']"
                                :Value = "position"

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

                    </div>
                </form>

                <div class=" pl-7 p-6.5"  style="display: flex; justify-content: center">
                    <loader-spinning v-if="Loader" style="margin: 0 auto; " />
                    <button v-if="!Loader" @click="sendData" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">
                        {{getName('Save')}}
                    </button>
                </div>
            </div>

        </div>
    </div>
    <!-- ====== Form Layout Section End -->

</template>
<script >
import {permissions, testLogin, updatePassword} from "@/Api.js";
import Input from "@/ui-components/Form/Input.vue";
import {useConterStore} from "@/store/counter.js";
import Checkbox from "@/ui-components/Form/Checkbox.vue";
import InputColor from "@/ui-components/Form/InputColor.vue";
import {employeeCreate} from "@/Api.js";
import {showEmployee} from "@/Api.js";
import {updateEmployee} from "@/Api.js";
import ImageInput from "@/components/Pages/Employees/Update/Inputs/ImageInput.vue";
import {Alert} from "@/Config.js";
import Checkbox01 from "@/ui-components/Form/Checkbox/Checkbox01.vue";
import Table from "@/components/Pages/Patients/Table.vue";
export default {
    data(){
        return{
            name: '',
            position: '',
            login: '',
            profil_photo_path: '',
            percent_salary: '',
            salary_static: '',
            isPasswordError: false,
            password: '',
            reset_password: '',
            isLoginError: false,
            color: '#FFFFFF',
            errorObj: {},
            image: '',
            photo: '',
            Roles: [],
            Permissions: [],
            PermissionsArr: [],
            Loader: false,

        }
    },
    components:{Table, Checkbox01, ImageInput, InputColor, Checkbox, Input},
    methods:{
        addRoles(role){
            if(this.Roles.includes(role)){
                this.Roles = this.Roles.filter((item) => item != role);
                this.PermissionsArr = this.PermissionsArr.filter((e) => e.role_id != role);
            }else{
                this.Roles.push(role);
            }
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

        async getPermissions(){
            const response = await permissions();
            this.Permissions = response.data
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

        getName(val){
            return useConterStore().getName(val)
        },
        testPassword(val){
            if (this.password != val){
                this.isPasswordError = true;
                this.Loader = false;
            }else {
                this.isPasswordError = false;
            }
            this.reset_password = val;
            return this.isPasswordError;

        },

        async update(){
            this.Loader = true;
            var data = {
                'name': this.name,
                'position': this.position,
                'login': this.login,
                'profil_photo_path': this.profil_photo_path,
                'percent_salary': this.percent_salary,
                'salary_static': this.salary_static,
                'sort_order': this.sort_order,
                'color': this.color,
                'image': this.image,
                'roles': this.Roles,
                'permissions': this.PermissionsArr
            }

            const response = await updateEmployee(this.$route.query.id, data);

            if (response.status){
                localStorage.setItem('user', JSON.stringify(response.data));
                Alert('success', 'Updated successfully !')
                this.$router.push('/employees')
            }else {
                console.log('data',response.data)
                this.errorObj = response.data;
                this.Loader = false;
            }
            this.Loader = false;

        },
        async updatePassword(){
            if (this.password != undefined && this.password.length > 0){
                console.log('R 1', this.password)
                if (this.testPassword(this.reset_password) != true){
                    var data = {
                        'id': this.$route.query.id,
                        'password': this.password,
                    }
                    const response = await updatePassword(data);
                    if (response.status){
                        this.update();
                    }else {
                        console.log(response.data)
                        this.errorObj = response.data;
                    }
                }
            }else {
                console.log('R 2')
                this.update();
            }

        },
        async sendData(){
            this.Loader = true;
            const val = this.login;
            const response = await testLogin({
                'login': val,
                'id': this.$route.query.id
            });
            if (response.status){
                this.isLoginError = true;
                this.Loader = false;
            }else {
                this.isLoginError = false;
                this.updatePassword();
            }
        },
        async get(){

            const response = await showEmployee(this.$route.query.id);
            const item = response.data;
            console.log(item)
            if (response.status){
                this.name = item.name
                this.position = item.position
                this.login = item.login
                this.password = item.password
                this.profil_photo_path = item.profil_photo_path
                this.percent_salary = item.percent_salary
                this.salary_static = item.salary_static
                this.sort_order = item.sort_order
                this.photo = item.image[0].url;

                item.roles.forEach((e) => {
                    this.Roles.push(e.id);
                })

                if (item.permissions.length > 0){
                    item.permissions.forEach((e)=>{
                        this.PermissionsArr.push({
                            role_id: e.role_id,
                            permission_id: e.permission_id,
                        });
                    })
                }
                this.color = item.color == null ? '#ffffff' :  item.color;

            }else {
                console.log('data:', response.data)
                this.errorObj = response.data;
            }

        },
        async testLogin(val){
            this.login = val;
            const response = await testLogin({
                'login': val,
                'id': this.$route.query.id
            });

            if (response.status){
                this.isLoginError = true;
            }else {
                this.isLoginError = false;
            }
        },
        hasKey(key) {
            return key in this.errorObj;
        },

        addPermission(role_id, permission_id){

            if (!this.hasPermission(role_id, permission_id)){
                this.PermissionsArr.push({
                    role_id: role_id,
                    permission_id: permission_id,
                });
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

    },
    mounted() {
        this.get()
        this.getPermissions()

    }

}
</script>


<style>

.list01{
    padding: 5px 27px;
    display: flex;
    justify-content: space-between;
}
.td_hidden{
    opacity: 0.5;
    pointer-events: none;
}

</style>
