<template>

    <!--begin::Aside-->
    <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">

        <Brand :Logo = "Logo" > </Brand>

        <AsideMenu >
            <MenuList  />
            <MenuListChildren >
                <MenuList />
                <MenuList />
                <MenuList />
                <MenuList />
                <MenuList />
                <MenuList />
                <MenuList />
            </MenuListChildren>
            <MenuList />

        </AsideMenu>


    </div>
    <!--end::Aside-->

</template>
<script >

    import Brand from "./Brand.vue";
    import AsideMenu from "./AsideMenu.vue";
    import MenuList from "./MenuList.vue";
    import MenuListChildren from "./MenuListChildren.vue";

    export default {
        name: 'Aside',
        components: {MenuListChildren, MenuList, AsideMenu, Brand},
        props:{
            Logo: String
        },
    }
</script>
