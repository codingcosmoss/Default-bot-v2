<template>
    <div class="vertical-menu">
        <div data-simplebar class="h-100">


            <MenuBox>

                <MenuButton
                    Title="Home"
                    Path="/admin"
                    Icon="bx bx-home-circle"
                />
                <MenuButton
                    Title="Mavzular"
                    Path="/admin/topic"
                    Icon="bx bx-command"
                />
                <MenuButton
                    Title="So'zlar"
                    Path="/admin/words"
                    Icon="bx bx-detail"
                />

                <MenuButton
                    Title="So'z olingan manbalar"
                    Path="/admin/sources"
                    Icon="bx bx-detail"
                />

                <MenuButton
                    Title="Saqlash uchun so'zlar"
                    Path="/admin/save-words"
                    Icon="bx bx-detail"
                />



            </MenuBox>



        </div>
    </div>
</template>
<script setup>
import MenuBox from "@/ui-components/Containers/MenuBox.vue";
import MenuButton from "@/ui-components/Containers/MenuButton.vue";
import MenuListButton from "@/ui-components/Containers/MenuListButton.vue";
</script>
