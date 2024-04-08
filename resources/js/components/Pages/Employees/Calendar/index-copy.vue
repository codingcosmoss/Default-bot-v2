<template>
        <Page :Classes = "false" :Animation = "false"   >

            <!-- Breadcrumb Start -->
            <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-title-md2 font-bold text-black dark:text-white">
                    Calendar
                </h2>

                <nav>
                    <ol class="flex items-center gap-2">
                        <li><a class="font-medium cursor-pointer" @click = "this.$router.push('/employees')"> {{getName('employees')}} /</a></li>
                        <li  class=" font-medium text-primary">Calendar</li>
                    </ol>
                </nav>
            </div>
            <!-- Breadcrumb End -->

            <!-- ====== Calendar Section Start -->
            <div
                class="w-full max-w-full rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                <table class="w-full">
                    <thead>
                    <tr class="grid grid-cols-7 rounded-t-sm bg-primary text-white">
                        <th
                            class="flex h-15 items-center justify-center rounded-tl-sm p-1 text-xs font-semibold sm:text-base xl:p-5">
                            <span class="hidden lg:block"> Sunday </span>
                            <span class="block lg:hidden"> Sun </span>
                        </th>
                        <th class="flex h-15 items-center justify-center p-1 text-xs font-semibold sm:text-base xl:p-5">
                            <span class="hidden lg:block"> Monday </span>
                            <span class="block lg:hidden"> Mon </span>
                        </th>
                        <th class="flex h-15 items-center justify-center p-1 text-xs font-semibold sm:text-base xl:p-5">
                            <span class="hidden lg:block"> Tuesday </span>
                            <span class="block lg:hidden"> Tue </span>
                        </th>
                        <th class="flex h-15 items-center justify-center p-1 text-xs font-semibold sm:text-base xl:p-5">
                            <span class="hidden lg:block"> Wednesday </span>
                            <span class="block lg:hidden"> Wed </span>
                        </th>
                        <th class="flex h-15 items-center justify-center p-1 text-xs font-semibold sm:text-base xl:p-5">
                            <span class="hidden lg:block"> Thursday </span>
                            <span class="block lg:hidden"> Thur </span>
                        </th>
                        <th class="flex h-15 items-center justify-center p-1 text-xs font-semibold sm:text-base xl:p-5">
                            <span class="hidden lg:block"> Friday </span>
                            <span class="block lg:hidden"> Fri </span>
                        </th>
                        <th
                            class="flex h-15 items-center justify-center rounded-tr-sm p-1 text-xs font-semibold sm:text-base xl:p-5">
                            <span class="hidden lg:block"> Saturday </span>
                            <span class="block lg:hidden"> Sat </span>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- Line 1 -->
                    <tr class="grid grid-cols-7">

                        <td v-for="i in 31"
                            class="ease relative h-20 cursor-pointer border border-stroke p-2 transition duration-500 hover:bg-gray dark:border-strokedark dark:hover:bg-meta-4 md:h-25 md:p-6 xl:h-31">
                            <span class="font-medium text-black dark:text-white">{{i}}</span>
                            <Item v-if="i ==1"></Item>
                        </td>

                    </tr>

                    </tbody>
                </table>
            </div>
            <!-- ====== Calendar Section End -->

        </Page>
</template>
<script >
import Page from "../../../Layout/Page.vue";
import Item from "./Item.vue";
import {useConterStore} from "../../../../store/counter.js";
import {getName} from "../../../../Config.js";
export default {
    components: {Item, Page},
    methods: {
        getName(val){
            return useConterStore().getName(val)
        },
    },

}
</script>
