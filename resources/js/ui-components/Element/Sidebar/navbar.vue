<template>
    <ul class="mb-6 flex flex-col gap-1.5">

        <Menu
            Path = "/"
            Title = "Components"
            Icon = "fa-solid fa-window-restore"
        />

        <Menu
            Path = "/employees"
            :Title = "getName('employees')"
            Icon = "fa-solid fa-user-group"
        />
        <Menu
            Path = "/services"
            :Title = "getName('services')"
            Icon = "fa-regular fa-hospital"
        />
        <Menu
            Path = "/service-categories"
            :Title = "getName('service_types')"
            Icon = "fa-solid fa-truck-medical"
        />
        <Menu
            Path = "/patients"
            :Title = "getName('Patients')"
            Icon = "fa-solid fa-hospital-user"
        />

        <Menu
            Path = "/diseases"
            :Title = "getName('diseases')"
            Icon = "fa-solid fa-book"
        />

        <Menu
            Path = "/treatmetns"
            :Title = "getName('Treatmetns')"
            Icon = "fs-5 fas fa-book-medical"
        />

        <Menu
            Path = "/payments"
            :Title = "getName('Payments')"
            Icon = "fa-solid fa-money-check-dollar"
        />

        <Menu
            Path = "/payment-types"
            :Title = "getName('PaymentTypes')"
            Icon = "fa-solid fa-credit-card"
        />

        <MenuList
            :Selected = " ['/warehouses', '/groups', '/products', '/filials', '/warehouse-categories'].includes(this.$route.path)"
            :Title = "getName('Warehouse')" Icon = "fa-solid fa-warehouse" :title = "getName('Warehouse')">
            <Menu
                Path = "/warehouses"
                :Title = "getName('Warehouse')"
                Icon = "fa-solid fa-house-circle-check"
                style="margin-right: 20px"
                :class="  ['/warehouses', '/groups', '/products'].includes(this.$route.path) ? 'navbar-active' : '' "
            />
            <Menu
                Path = "/filials"
                :Title = "getName('Filials')"
                Icon = "fa-solid fa-f"
                style="margin-right: 20px"

            />
            <Menu
                Path = "/warehouse-categories"
                :Title = "getName('Categories')"
                Icon = "fa-solid fa-c"
                style="margin-right: 20px"

            />
        </MenuList>

        <Menu
            Path = "/debt-treatments"
            :Title = "getName('DebtTreatments')"
            Icon = "fa-solid fa-money-check-dollar"
        />

        <Menu
            Path = "/employee-reports"
            :Title = "getName('EmployeeReports')"
            Icon = "fa-solid fa-money-check"
        />

        <Menu
            Path = "/paying-employees"
            :Title = "getName('PayingEmployees')"
            Icon = "fa-solid fa-money-bills"
        />

        <Menu
            Path = "/daily-expenses"
            :Title = "getName('DailyExpenses')"
            Icon = "fa-solid fa-file-contract"
        />

        <Menu
            Path = "/reports"
            :Title = "getName('Reports')"
            Icon = "fa-solid fa-layer-group"
        />





    </ul>
</template>
<script >
import MenuList from './menuList.vue';
import Menu from './menu.vue';
import {useConterStore} from "../../../store/counter.js";
// import {useConterStore} from "@/store/counter.js";

export default {
    components: {Menu, MenuList},
    data(){
        return{
            selected: '',
            page: '',
        }
    },



    methods:{
        getName(val){
            return useConterStore().getName(val)
        }
    },

    mounted() {
        this.getName()
    }
}
</script>
