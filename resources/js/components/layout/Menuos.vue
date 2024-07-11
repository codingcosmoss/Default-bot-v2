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
                        icon:'bx bx-home-circle'
                    },
                     {
                        title: 'Tables',
                        path: '/admin/docs/tables',
                        icon:'bx bx-list-ul'
                    },
                        {
                        title: 'Forms',
                        path: '/admin/docs/forms',
                        icon:'bx bx-file'
                    },

                ]"
        />

        <MenuButton
            :Title="$t('Dashboard')"
            Name="Dashboard"
            Icon="bx bx-home-circle"
            Path="/admin"
            @click="onMenuMedia()"
        />


    </MenuBox>

</template>
<script>
import MenuBox from "@/ui-components/Containers/MenuBox.vue";
import MenuButton from "@/ui-components/Containers/MenuButton.vue";
import MenuListButton from "@/ui-components/Containers/MenuListButton.vue";
export default
{
    components:{MenuBox, MenuButton, MenuListButton},
    methods:{
        onMenuMedia(){
            const body = document.getElementById('body');

            if (body.classList.contains('sidebar-enable')){
                body.classList.remove('sidebar-enable');

            }else {
                body.classList.add('sidebar-enable');

            }
        },
    }
}
</script>
