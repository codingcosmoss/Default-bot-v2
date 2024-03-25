<template>
    <!-- Card Item Start -->
    <div
        class="cursor-pointer rounded-sm border border-stroke bg-white py-6 px-7.5 shadow-default dark:border-strokedark dark:bg-boxdark">
        <div
            class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
            <i class="fa-solid fa-user" style="font-size: 25px" ></i>
        </div>

        <div class="mt-4 flex items-end justify-between">
            <div>
                <h4 class="text-title-md font-bold text-black dark:text-white mb-3" style="font-size: 20px">
                    {{Title}}
                </h4>
                <i class="fas fa-check-circle text-success"></i> &nbsp;
                <span class="text-sm font-bold " style="font-size: 17px;">{{getName('PaymentTreatments')}}: {{Text1}}</span>
                <br>
                <i class="fas fa-times-circle text-danger"></i> &nbsp;
                <span class="text-sm font-bold " style="font-size: 17px;">{{getName('DebtorFinishedTreatments')}}: {{Text2}}</span>
            </div>

        </div>
    </div>
    <!-- Card Item End -->
</template>
<script >
    import {getName} from "../../../../Config.js";
    import {useConterStore} from "@/store/counter.js";
    export default {
        props:{
            Title:{
                type: [String, Number],
                default: 'Title'
            },
            Link:{
                type: [String, Number],
                default: '/'
            },
            Text1:{
                type: [String, Number],
                default: 'Text'
            },
            Text2:{
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
