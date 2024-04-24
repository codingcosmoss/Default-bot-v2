<template>
    <ul class="mb-6 flex flex-col gap-1.5">

        <Menu
            Path = "/"
            :Title = "getName('Home')"
            Icon = "fa-solid fa-house"
        />

        <Menu
            Path = "/employees"
            :Title = "getName('employees')"
            Icon = "fa-solid fa-user-group"
            v-if = "Roles.includes('employees')"
        />
        <Menu
            Path = "/services"
            :Title = "getName('services')"
            Icon = "fa-regular fa-hospital"
            v-if = "Roles.includes('services')"
        />
        <Menu
            Path = "/service-categories"
            :Title = "getName('service_types')"
            Icon = "fa-solid fa-truck-medical"
            v-if = "Roles.includes('service_types')"
        />
        <Menu
            Path = "/patients"
            :Title = "getName('Patients')"
            Icon = "fa-solid fa-hospital-user"
            v-if = "Roles.includes('Patients')"
        />

        <Menu
            Path = "/diseases"
            :Title = "getName('diseases')"
            Icon = "fa-solid fa-book"
            v-if = "Roles.includes('diseases')"
        />

        <Menu
            Path = "/treatmetns"
            :Title = "getName('Treatmetns')"
            Icon = "fs-5 fas fa-book-medical"
            v-if = "Roles.includes('Treatmetns')"
        />

        <Menu
            Path = "/debt-treatments"
            :Title = "getName('DebtTreatments')"
            Icon = "fa-solid fa-book-medical"
            v-if = "Roles.includes('DebtTreatments')"
        />

        <Menu
            Path = "/payments"
            :Title = "getName('Payments')"
            Icon = "fa-solid fa-money-check-dollar"
            v-if = "Roles.includes('Payments')"
        />

        <Menu
            Path = "/payment-types"
            :Title = "getName('PaymentTypes')"
            Icon = "fa-solid fa-credit-card"
            v-if = "Roles.includes('PaymentTypes')"
        />

        <MenuList
            v-if = "Roles.includes('Warehouse')"

            :Selected = " ['/warehouses', '/groups', '/products', '/warehouse-categories'].includes(this.$route.path)"
            :Title = "getName('Warehouse')" Icon = "fa-solid fa-warehouse" :title = "getName('Warehouse')">
            <Menu
                Path = "/warehouses"
                :Title = "getName('Warehouse')"
                Icon = "fa-solid fa-house-circle-check"
                style="margin-right: 20px"
                :class="  ['/warehouses', '/groups', '/products'].includes(this.$route.path) ? 'navbar-active' : '' "
            />
<!--            <Menu-->
<!--                Path = "/filials"-->
<!--                :Title = "getName('Filials')"-->
<!--                Icon = "fa-solid fa-f"-->
<!--                style="margin-right: 20px"-->

<!--            />-->
            <Menu
                Path = "/warehouse-categories"
                :Title = "getName('Categories')"
                Icon = "fa-solid fa-c"
                style="margin-right: 20px"
                v-if = "hasPermission('Warehouse-categories')"
            />

        </MenuList>



<!--        <Menu-->
<!--            Path = "/daily-staff-reports"-->
<!--            :Title = "getName('EmployeeReports')"-->
<!--            Icon = "fa-solid fa-money-check"-->
<!--        />-->


        <Menu
            Path = "/employees-payments"
            :Title = "getName('PayingEmployees')"
            Icon = "fa-solid fa-money-bills"
            v-if = "Roles.includes('PayingEmployees')"
        />

        <Menu
            Path = "/given-moneys"
            :Title = "getName('GivenMoney')"
            Icon = "nav-icon fs-5  fas fa-coins"
            style="margin-right: 20px"
            v-if = "Roles.includes('GivenMoney')"

        />


        <Menu
            Path = "/daily-cost"
            :Title = "getName('DailyExpenses')"
            Icon = "fa-solid fa-file-contract"
            v-if = "Roles.includes('DailyExpenses')"
        />

        <Menu
            Path = "/reports"
            :Title = "getName('Reports')"
            Icon = "fa-solid fa-layer-group"
            v-if = "Roles.includes('Reports')"
        />

        <Menu
            Path = "/telegrams"
            :Title = "getName('Telegram')"
            Icon = "fa-brands fa-telegram"
            v-if = "Roles.includes('Telegram')"
        />

        <Menu
            Path = "/settings"
            :Title = "getName('Settings')"
            Icon = "fa-solid fa-gear"
            v-if = "Roles.includes('Settings')"
        />





    </ul>
</template>
<script >
import MenuList from './menuList.vue';
import Menu from './menu.vue';
import {useConterStore} from "../../../store/counter.js";
import {GetUser, showEmployee} from "@/Api.js";
import {getUserPermissions} from "@/Api.js";
// import {useConterStore} from "@/store/counter.js";

export default {
    components: {Menu, MenuList},
    data(){
        return{
            selected: '',
            page: '',
            Roles: [],
        }
    },



    methods:{
        getName(val){
            return useConterStore().getName(val)
        },
        hasRoles(){
            console.log('Route pathL', this.$route.path)
        },

        async getUser(){
            let localRoles = localStorage.getItem('roles');
            if (localRoles == null || localRoles == ''){
                const response = await GetUser();

                if (response.success == 200){

                    response.data.roles.forEach((e) => {
                        this.Roles.push(e.lang_name);
                    });
                    localStorage.setItem('roles',  this.caesarCipher( this.Roles.join(',') , 7) );
                }else{
                    this.$router.push('/login');
                }
            }else{
                this.Roles =  this.caesarDecipher( localRoles, 7).split(',') ;
            }

            this.savePermissions();
            console.log(this.Roles)


        },
        async savePermissions(id){
            let user = JSON.parse(localStorage.getItem('user'));
            const response = await getUserPermissions(user['id']);
            let permissionsArr = [];
            response.data.forEach((e)=>{
                permissionsArr.push(e.name);
            })
            localStorage.setItem('permissions', permissionsArr );
        },


         caesarCipher(input, shift) {
            let result = '';
            for (let i = 0; i < input.length; i++) {
                let charCode = input.charCodeAt(i);
                if (charCode >= 65 && charCode <= 90) {
                    result += String.fromCharCode(((charCode - 65 + shift) % 26) + 65);
                } else if (charCode >= 97 && charCode <= 122) {
                    result += String.fromCharCode(((charCode - 97 + shift) % 26) + 97);
                } else {
                    result += input[i];
                }
            }
            return result;
        },

        caesarDecipher(input, shift) {
            let result = '';
            for (let i = 0; i < input.length; i++) {
                let charCode = input.charCodeAt(i);
                if (charCode >= 65 && charCode <= 90) {
                    result += String.fromCharCode(((charCode - 65 - shift + 26) % 26) + 65);
                } else if (charCode >= 97 && charCode <= 122) {
                    result += String.fromCharCode(((charCode - 97 - shift + 26) % 26) + 97);
                } else {
                    result += input[i];
                }
            }
            return result;
        },
        hasPermission(value){
            let permissions = localStorage.getItem('permissions').split(',');
            if (permissions.includes(value)){
                return true;
            }else {
                return false;
            }
        },



},

    mounted() {
        this.hasRoles()
        this.getUser()
        this.getName()
    }
}
</script>
