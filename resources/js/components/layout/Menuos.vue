<template>

    <MenuBox>

<!--        <MenuListButton-->
<!--            Title="Documentation"-->
<!--            Name="Documentation"-->
<!--            Icon="bx bxs-copy-alt"-->
<!--            :ChildLinks="[-->
<!--                    {-->
<!--                        title: 'Dashboard',-->
<!--                        path: '/admin/docs/dashboard',-->
<!--                        icon:'bx bx-home-circle',-->
<!--                        isPermission: true-->
<!--                    },-->
<!--                     {-->
<!--                        title: 'Tables',-->
<!--                        path: '/admin/docs/tables',-->
<!--                        icon:'bx bx-list-ul',-->
<!--                        isPermission: true-->
<!--                    },-->
<!--                        {-->
<!--                        title: 'Forms',-->
<!--                        path: '/admin/docs/forms',-->
<!--                        icon:'bx bx-file',-->
<!--                        isPermission: true-->
<!--                    },-->

<!--                ]"-->
<!--        />-->

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
