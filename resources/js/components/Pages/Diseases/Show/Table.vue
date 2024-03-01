<template >
    <div class="col-span-12 xl:col-span-12">
        <!-- Breadcrumb Start -->
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between" style="justify-content: flex-end">

            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium cursor-pointer" @click = "this.$router.push('/employees')"> {{getName('employees')}} /</a></li>
                    <li  class=" font-medium text-primary">{{getName('show')}}</li>
                </ol>
            </nav>
        </div>
        <div
            style="max-width: 500px; margin: 0 auto"
            class="rounded-sm border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <h4 class="mb-6 text-xl font-bold text-black dark:text-white">
                {{item.name}}
            </h4>

            <table border="1" >

                <tr>
                    <th>{{getName('fio')}}:</th>
                    <td>{{item.name}}</td>
                </tr>
                <tr>
                    <th>{{getName('position')}}:</th>
                    <td>{{item.position}}</td>
                </tr>
                <tr>
                    <th>{{getName('login')}}:</th>
                    <td>{{item.login}}</td>
                </tr>
                <tr>
                    <th>{{getName('color')}}:</th>
                    <td>
                        <div style="width: 40px; height: 20px; " :style = " 'background:'+item.color +'' " ></div>
                    </td>
                </tr>
                <tr>
                    <th>{{getName('serial_number')}}:</th>
                    <td>{{item.sort_order}}</td>
                </tr>
                <tr>
                    <th>{{getName('image')}}:</th>
                    <td style="border: 2px solid rgba(235,152,8,0.82)" > <div class="photo-img" :style="'background-image: url(' + item.image + ')'" style="width: 100px; height: 100px" ></div></td>
                </tr>

            </table>


        </div>
    </div>

</template>
<script>
import {useConterStore} from "../../../../store/counter.js";
import TableHeader from "./Table-header.vue";
import {showEmployee} from "../../../../Api.js";
import Table from "../Table.vue";

export default {
    components: {Table, TableHeader},
    data(){
        return{
            item: [],
            search: '',
            column: 'sort_order',
            order: 'asc',
            paginate: 10,
            pagination: {},
            current_page: 1
        }
    },
    methods:{
        router() {
            return router
        },
        getName(val){
            return useConterStore().getName(val)
        },
        async getItem(){
            const response = await showEmployee(this.$route.query.id);
            console.log( response.data)
            this.item = response.data;

        },



    },
    mounted() {
        this.getItem()
    }
}
</script>
<style >
    .fa-solid{cursor: pointer}
    table {
        /* /* border-collapse: separate; */ */
        border-spacing: 30px; /* Masofani o'zgartiring */
    }
    tr{
        /* display: flex; */
        /* margin: 15px 0; */
    }
    td{
        margin-left: 30px;
    }

    .btn01{
        width: 100px;
        margin-left: 100px;
        background: rgba(0, 0, 0, 0.12);
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;

    }
    .btn01 svg{
        background: rgba(46, 58, 71, 0.07);
        border: 1px solid rgba(245, 245, 245, 0.33);
        margin: 0 10px;
        border-radius: 10px;
        color: white;
        cursor: pointer;
    }
    .btn01 svg:active{
        transform: scale(0.9);
    }
    .active{
        background: #10B981 !important;
        color: #2E3A47 !important;
    }


</style>
