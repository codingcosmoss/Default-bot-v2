<template>
    <!-- Card Item Start -->
    <div
        class="cursor-pointer rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
        <div
            class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
            <i :class="Icon" style="font-size: 25px" ></i>
        </div>

        <div class="mt-4 flex items-end justify-between">
            <div>
                <h4 class="text-title-md font-bold text-black dark:text-white mb-3" style="font-size: 20px">
                    {{Title}}
                </h4>
                <span class="text-sm font-bold " style="font-size: 17px;">{{useConterStore().formatNumber(Text)}}</span>
                <br>
            </div>

        </div>
    </div>
    <!-- Card Item End -->
</template>
<script >
    import {getName} from "../../../../Config.js";
    import {useConterStore} from "@/store/counter.js";
    export default {
        setup(){
            return{ useConterStore}
        },
        props:{
            Title:{
                type: [String, Number],
                default: 'Title'
            },
            Link:{
                type: [String, Number],
                default: '/'
            },
            Text:{
                type: [String, Number],
                default: 'Text'
            },

            Item:{
                type: [String, Number],
                default: '0'
            },
            Icon:{
                type: [String, Number],
                default: '0'
            },

        },
        methods:{

            getName(val){
                return useConterStore().getName(val)
            },


        },
    }
</script>
