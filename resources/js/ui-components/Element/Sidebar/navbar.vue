<template>
    <ul class="mb-6 flex flex-col gap-1.5">

        <Menu
            Path = "/"
            Title = "Components"
            Icon = "fa-solid fa-window-restore"
        />

<!--        <MenuList>-->
<!--            <Menu />-->
<!--        </MenuList>-->

<!--        <Menu />-->


    </ul>
</template>
<script >
import MenuList from './menuList.vue';
import Menu from './menu.vue';
export default {
    components: {Menu, MenuList},
    data(){
        return{
            selected: '',
            page: '',
        }
    },
}
</script>
