<template>

    <div class="grid grid-cols-5 border-b border-stroke dark:border-strokedark sm:grid-cols-5 overflow-x-auto" >

        <div class="flex items-center justify-center p-2.5 xl:p-5 ">
            <p class="font-medium text-black dark:text-white "> {{getName('name_content')}}</p>
        </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('color')}}</p>
        </div>

        <div class="flex items-center justify-center p-2.5 xl:p-5">
            <p class="font-medium text-black dark:text-white"> {{getName('Patients')}}</p>
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
