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
                        title: 'Test',
                        path: '/admin/',
                        icon:'bx bx-home-circle'
                    },

                ]"
        />

    </MenuBox>

</template>
<script setup>
import MenuBox from "@/ui-components/Containers/MenuBox.vue";
import MenuButton from "@/ui-components/Containers/MenuButton.vue";
import MenuListButton from "@/ui-components/Containers/MenuListButton.vue";
</script>
