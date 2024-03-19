
<template>

    <div class="grid grid-cols-6 border-b border-stroke dark:border-strokedark sm:grid-cols-6 overflow-x-auto" >

        <div class="flex items-center  justify-content-end p-2.5 xl:p-5" >
            <p class="font-medium text-black dark:text-white  "  > {{getName('name_content')}}</p>
        </div>
        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('Bar_code')}}</p>
        </div>
        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('SizeType')}}</p>
        </div>
        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('Amount')}}</p>
        </div>
        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('price')}}</p>
        </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('TotalAmount')}}</p>
        </div>

    </div>

</template>
<script >
import {useConterStore} from "@/store/counter.js";

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

