<template>
    <div class="vertical-menu">
        <div data-simplebar class="h-100">


            <MenuBox>
                <MenuButton/>
                <MenuButton/>
                <MenuButton/>
            </MenuBox>



        </div>
    </div>
</template>
<script setup>
import MenuBox from "@/ui-components/Containers/MenuBox.vue";
import MenuButton from "@/ui-components/Containers/MenuButton.vue";
</script>
