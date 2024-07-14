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
