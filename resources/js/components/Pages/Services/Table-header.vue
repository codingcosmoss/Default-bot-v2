
<template>

    <div class="grid grid-cols-7 border-b border-stroke dark:border-strokedark sm:grid-cols-7 overflow-x-auto media_header" >

        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p  class="font-medium text-black dark:text-white"> {{getName('name_content')}}</p>
        </div>

        <!--
        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('code')}}</p>
        </div>
        -->

        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('price')}}</p>
        </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('category')}}</p>
        </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('material_price')}}</p>
        </div>
        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('technic_price')}}</p>
        </div>
        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('status')}}</p>
        </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('actions')}}</p>
        </div>
    </div>

</template>
<script >
import {useConterStore} from "../../../store/counter.js";

export default {
    data(){
        return{
            order: 'asc',
            search: '',
            column: 'id'
        }
    },
    methods:{
        getName(val){
            return useConterStore().getName(val)
        }
    },
}
</script>

<style scoped>
p{
    font-weight: bold;
}
</style>

