<template>

    <div class="grid grid-cols-6 border-b border-stroke dark:border-strokedark sm:grid-cols-6 overflow-x-auto" >

        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('fio')}}</p>
        </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('position')}}</p>
        </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('login')}}</p>
        </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('color')}}</p>
        </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('serial_number')}}</p>
        </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('actions')}}</p>
        </div>
    </div>

</template>
<script >
import {useConterStore} from "../../../../store/counter.js";

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
