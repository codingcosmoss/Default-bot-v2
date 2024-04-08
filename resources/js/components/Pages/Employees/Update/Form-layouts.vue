<template>


    <!-- Breadcrumb Start -->
    <div class=" breadcrumb-nav mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between" >

        <nav>
            <ol class="flex items-center gap-2">
                <li><a class="font-medium cursor-pointer" @click = "this.$router.push('/employees')"> {{getName('employees')}} /</a></li>
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
                            :isError = "isLoginError"
                            message = "Login is available !"


                        />


                        <div class="mb-4.5 flex flex-col gap-6 xl:flex-row">
                            <InputColor
                                Type = "color"
                                :Couple = "false"
                                :Label = "getName('color')"
                                @onInput = "color = $event"
                                :isError = "hasKey('color')"
                                :message = "errorObj['color']"
                                :Value = "color"

                            />
                            <Input
                                Type = "number"
                                :Couple = "false"
                                :Label = "getName('Serial_number')"
                                @onInput = "sort_order = $event"
                                :isError = "hasKey('sort_order')"
                                :message = "errorObj['sort_order']"
                                :Value = "sort_order"


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


                <p class="pt-0 p-6.5" > {{getName('employee_roles')}}:</p>


                <ul  style="display: flex; padding: 5px 27px" >

                    <li>
                        <!--                        Xodimloar menyusini ko'rish-->
                        <span  v-for="permission in Permissions.slice(0, 10)" >
                           <Checkbox01

                               @click = "addRoles(permission['id'])"
                               :onCheck = "Roles.includes(permission['id'])"
                               :Title = "getName(permission['lang_name'])"
                               Class = "genderCheckbox"
                           />
                       &nbsp;
                       </span>

                    </li>
                    &nbsp;&nbsp;
                    &nbsp;&nbsp;
                    &nbsp;&nbsp;
                    &nbsp;&nbsp;
                    &nbsp;&nbsp;
                    <li>
                        <!--                        Xodimloar menyusini ko'rish-->
                        <span  v-for="permission in Permissions.slice(10, Permissions.length )">
                           <Checkbox01
                               @click = "addRoles(permission['id'])"
                               :onCheck = "Roles.includes(permission['id'])"
                               :Title = "getName(permission['lang_name'])"
                               Class = "genderCheckbox"
                           />
                       &nbsp;
                       </span>

                    </li>

                </ul>



                <div class=" pl-7 p-6.5">

                    <button @click="update" class="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray">
                        {{getName('create')}}
                    </button>
                </div>
            </div>

        </div>
    </div>
    <!-- ====== Form Layout Section End -->

</template>
<script >
import {permissions, testLogin} from "../../../../Api.js";
import Input from "./Inputs/Input.vue";
import {useConterStore} from "../../../../store/counter.js";
import Checkbox from "./Inputs/Checkbox.vue";
import InputColor from "./Inputs/InputColor.vue";
import {employeeCreate} from "../../../../Api.js";
import {showEmployee} from "../../../../Api.js";
import {updateEmployee} from "../../../../Api.js";
import ImageInput from "./Inputs/ImageInput.vue";
import {Alert} from "../../../../Config.js";
import Checkbox01 from "@/ui-components/Form/Checkbox/Checkbox01.vue";
export default {
        data(){
            return{
                name: '',
                position: '',
                login: '',
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
                photo: '',
                Roles: [],
                Permissions: []

            }
        },
        components:{Checkbox01, ImageInput, InputColor, Checkbox, Input},
        methods:{
            addRoles(role){
                if(this.Roles.includes(role)){
                    this.Roles = this.Roles.filter((item) => item != role);
                }else{
                    this.Roles.push(role);
                }
            },

            async getPermissions(){
                const response = await permissions();
                this.Permissions = response.data
            },


            getName(val){
                return useConterStore().getName(val)
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

            async update(){
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
                }
                console.log(data)

                const response = await updateEmployee(this.$route.query.id, data);

                if (response.status){
                    Alert('success', 'Updated successfully !')
                    this.$router.push('/employees')
                }else {
                    console.log('data',response.data)
                    this.errorObj = response.data;
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
                    item.permissions.forEach((e) => {
                        this.Roles.push(e.id);
                    })
                    this.color = item.color == null ? '#ffffff' :  item.color;

                }else {
                    console.log('data:', response.data)
                    this.errorObj = response.data;
                }

            },
            async testLogin(val){

                const response = await testLogin({
                    'login': val
                });

                if (response.status){
                    this.isLoginError = true;
                }else {
                    this.isLoginError = false;
                }
                this.login = val;
            },
            hasKey(key) {
                return key in this.errorObj;
            }

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

</style>
