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

        <MenuListButton
            :Title="$t('Employees')"
            Name="Employees"
            Icon="bx bxs-user-detail"
            v-if="counterStore.hasRole('Employees-index')"
            :ChildLinks="[
                    {
                        title: $t('AllEmployees'),
                        path: '/admin/users',
                        icon:'bx bxs-contact',
                        isPermission: this.counterStore.hasRole('Employees-index')
                    },
                     {
                        title: $t('Role&Permission'),
                        path: '/admin/roles',
                        icon:'bx bxs-check-shield',
                        isPermission: this.counterStore.hasRole('Role&Permissions-index')
                    },
                ]"
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
                        title: $t('Companies&Categories'),
                        path: '/admin/medicine-categories',
                        icon:'bx bx-collection',
                        isPermission: this.counterStore.hasRole('Medicines-index')
                    },
                    {
                        title: $t('SizeTypes'),
                        path: '/admin/size-types',
                        icon:'bx bx-paragraph',
                        isPermission: this.counterStore.hasRole('Medicines-index')
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
