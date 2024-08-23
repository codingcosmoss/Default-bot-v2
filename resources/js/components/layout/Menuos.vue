<template>

    <MenuBox>

        <MenuListButton
            Title="Documentation"
            Name="Documentation"
            Icon="bx bxs-copy-alt"
            :ChildLinks="[
                    {
                        title: 'Dashboard',
                        path: '/admin/docs/dashboard',
                        icon:'bx bx-home-circle',
                        isPermission: true
                    },
                     {
                        title: 'Tables',
                        path: '/admin/docs/tables',
                        icon:'bx bx-list-ul',
                        isPermission: true
                    },
                        {
                        title: 'Forms',
                        path: '/admin/docs/forms',
                        icon:'bx bx-file',
                        isPermission: true
                    },

                ]"
        />

        <MenuButton
            :Title="$t('Dashboard')"
            Name="Dashboard"
            Icon="bx bx-home-circle"
            Path="/admin"
            @click="onMenuMedia()"
            v-if="counterStore.hasRole('Dashboard-index')"
        />

        <MenuButton
            :Title="$t('Employees')"
            Name="Employees"
            Icon="bx bxs-user-detail"
            Path="/admin/users"
            @click="onMenuMedia()"
            v-if="counterStore.hasRole('Employees-index')"
        />
        <MenuButton
            :Title="$t('Role&Permission')"
            Name="Role&Permission"
            Icon="bx bxs-check-shield"
            Path="/admin/roles"
            @click="onMenuMedia()"
            v-if="counterStore.hasRole('Role&Permissions-index')"
        />

        <MenuButton
            :Title="$t('Settings')"
            Name="Settings"
            Icon="bx bx-cog "
            Path="/admin/settings"
            @click="onMenuMedia()"
            v-if="counterStore.hasRole('Settings-index')"
        />

        <MenuButton
            :Title="$t('Customers')"
            Name="Customers"
            Icon="bx bx-group"
            Path="/admin/customers"
            @click="onMenuMedia()"
            v-if="counterStore.hasRole('Customers-index')"
        />

        <MenuListButton
            :Title="$t('Expenses')"
            Name="Expenses"
            Icon="bx bx-notepad"
            v-if="counterStore.hasRole('Expenses-index')"
            :ChildLinks="[
                    {
                        title: $t('AllExpenses'),
                        path: '/admin/expenses',
                        icon:'bx bx-book-content',
                        isPermission: this.counterStore.hasRole('Expenses-index')
                    },
                     {
                        title: $t('ExpenseCategories'),
                        path: '/admin/expense/categories',
                        icon:'bx bx-circle',
                        isPermission: this.counterStore.hasRole('ExpenseCategories-index')
                    },
                ]"
        />
        <MenuButton
            :Title="$t('Suppliers')"
            Name="Suppliers"
            Icon="bx bx-group"
            Path="/admin/suppliers"
            @click="onMenuMedia()"
            v-if="counterStore.hasRole('Suppliers-index')"
        />
        <MenuListButton
            :Title="$t('Medicines')"
            Name="Medicines"
            Icon="bx bx-band-aid"
            v-if="counterStore.hasRole('Medicines-index')"
            :ChildLinks="[
                    {
                        title: $t('AllMedicines'),
                        path: '/admin/medicines',
                        icon:'bx bx-first-aid',
                        isPermission: this.counterStore.hasRole('MedicineCategories-index') || this.counterStore.hasRole('DrugCompanies-index')
                    },
                    {
                        title: $t('Companies&Categories'),
                        path: '/admin/medicine-categories',
                        icon:'bx bx-collection',
                        isPermission: this.counterStore.hasRole('MedicineCategories-index') || this.counterStore.hasRole('DrugCompanies-index')
                    },
                    {
                        title: $t('SizeTypes'),
                        path: '/admin/size-types',
                        icon:'bx bx-paragraph',
                        isPermission: this.counterStore.hasRole('DrugSizeTypes-index') || this.counterStore.hasRole('BoxSizes-index')
                    },
                ]"
        />
        <MenuListButton
            :Title="$t('Warehouse')"
            Name="Warehouse"
            Icon="bx bx-home-alt"
            v-if="counterStore.hasRole('Warehouse-index')"
            :ChildLinks="[
                    {
                        title: $t('Warehouse'),
                        path: '/admin/warehouse',
                        icon:'bx bx-building-house',
                        isPermission: this.counterStore.hasRole('Warehouse-index')
                    },
                      {
                        title: $t('ImportDocuments'),
                        path: '/admin/documents',
                        icon:'bx bx-import',
                        isPermission: this.counterStore.hasRole('ImportDocuments-index')
                    },
                    {
                        title: $t('ImportMedicines'),
                        path: '/admin/import/medicines',
                        icon:'bx bx-task',
                        isPermission: this.counterStore.hasRole('ImportDocuments-index')
                    },
                    {
                        title: $t('ReturnedMedicines'),
                        path: '/admin/returned/medicines',
                        icon:'bx bx-exit',
                        isPermission: this.counterStore.hasRole('ImportDocuments-index')
                    },

                ]"
        />
        <MenuListButton
            :Title="$t('Selling')"
            Name="Selling"
            Icon="bx bx-store-alt"
            v-if="counterStore.hasRole('Selling-index')"
            :ChildLinks="[
                    {
                        title: $t('SellingPage'),
                        path: '/selling',
                        icon:'bx bx-desktop',
                        isPermission: this.counterStore.hasRole('Selling-create')
                    },
                    {
                        title: $t('SellingArxive'),
                        path: '/admin/archive/invoices',
                        icon:'bx bx-archive',
                        isPermission: this.counterStore.hasRole('Selling-index')
                    },
                     {
                        title: $t('ReturnHistory'),
                        path: '/admin/returned/invoices',
                        icon:'bx bx-left-down-arrow-circle',
                        isPermission: this.counterStore.hasRole('Selling-index')
                    },

                ]"
        />

        <MenuListButton
            :Title="$t('Payments')"
            Name="PaymentTypes"
            Icon="bx bx-credit-card"
            Path="/admin/payment-types"
            v-if="counterStore.hasRole('Payments-index')"
            :ChildLinks="[
                   {
                        title: $t('PaymentTypes'),
                        path: '/admin/payment-types',
                        icon:'bx bxl-paypal',
                        isPermission: this.counterStore.hasRole('PaymentTypes-index')
                    },
                    {
                        title: $t('CustomerPayments'),
                        path: '/admin/customer/payments',
                        icon:'bx bx-user-pin',
                        isPermission: this.counterStore.hasRole('Payments-index')
                    },
                     {
                        title: $t('SupplierPayments'),
                        path: '/admin/supplier/payments',
                        icon:'bx bx-user-pin',
                        isPermission: this.counterStore.hasRole('Payments-index')
                    },
                ]"
        />
        <MenuListButton
            :Title="$t('Reports')"
            Name="Reports"
            Icon="bx bx-credit-card"
            Path="/admin/payment-types"
            v-if="counterStore.hasRole('Reports-index')"
            :ChildLinks="[
                     {
                        title: $t('SellingAndBuying'),
                        path: '/admin/payment-types',
                        icon:'bx bx-user-pin',
                        isPermission: this.counterStore.hasRole('Reports-index')
                    },
                      {
                        title: $t('MostSolds'),
                        path: '/admin/payment-types',
                        icon:'bx bx-user-pin',
                        isPermission: this.counterStore.hasRole('Reports-index')
                    },
                    {
                        title: $t('ProfitAndLoss'),
                        path: '/admin/payment-types',
                        icon:'bx bx-user-pin',
                        isPermission: this.counterStore.hasRole('Reports-index')
                    },
                     {
                        title: $t('BusinessProfitandloss'),
                        path: '/admin/payment-types',
                        icon:'bx bx-user-pin',
                        isPermission: this.counterStore.hasRole('Reports-index')
                    },

                ]"
        />

    </MenuBox>

</template>
<script>
import MenuBox from "@/ui-components/Containers/MenuBox.vue";
import MenuButton from "@/ui-components/Containers/MenuButton.vue";
import MenuListButton from "@/ui-components/Containers/MenuListButton.vue";
import {GetUser} from "../../helpers/api.js"
import {useConterStore} from "@/store/counter.js";
export default
{
    data(){return{
        permissions: []
    }},
    setup(){
        const counterStore = useConterStore();
        return{counterStore}
    },
    components:{MenuBox, MenuButton, MenuListButton},
    methods:{
        onMenuMedia(){
            const body = document.getElementById('body');

            if (body.classList.contains('sidebar-enable')){
                body.classList.remove('sidebar-enable');

            }else {
                body.classList.add('sidebar-enable');

            }
        }

    },
    mounted() {
    }
}
</script>
