<template>

    <h4 class="mb-6 text-xl font-bold text-black dark:text-white warehouse_topbar_text">

        <button @click = "this.$router.push('/warehouses')"  :class="this.$route.path == '/warehouses' ? 'warehouse_topbar_active' : '' " class="warehouse_topbar ">{{getName('Warehouse')}}</button>
        &nbsp;
        <button @click = "this.$router.push('/groups')" :class="this.$route.path == '/groups' ? 'warehouse_topbar_active' : '' " class="warehouse_topbar">{{getName('Groups')}}</button>
        &nbsp;
        <button @click = "this.$router.push('/products')" :class="this.$route.path == '/products' ? 'warehouse_topbar_active' : '' " class="warehouse_topbar">{{getName('Products')}}</button>
        &nbsp;
        <button @click = "this.$router.push('/collections')" :class="this.$route.path == '/collections' ? 'warehouse_topbar_active' : '' " class="warehouse_topbar">{{getName('Collection')}}</button>
        &nbsp;
        <button @click = "this.$router.push('/product-documents')" :class="this.$route.path == '/product-documents' ? 'warehouse_topbar_active' : '' " class="warehouse_topbar">{{getName('Documents')}}</button>
        &nbsp;
        <button @click = "this.$router.push('/suppliers')" :class="this.$route.path == '/suppliers' ? 'warehouse_topbar_active' : '' " class="warehouse_topbar">{{getName('Suppliers')}}</button>

    </h4>
</template>
<script >
    import {useConterStore} from "@/store/counter.js";

    export default {
        methods:{
            getName(val){
                return useConterStore().getName(val)
            },
        }
    }
</script>

<style scoped lang="scss">
    .warehouse_topbar_text{
        font-size: 17px;
        letter-spacing: 4px;
        button{
            letter-spacing: 0.9px;
        }
    }

</style>
