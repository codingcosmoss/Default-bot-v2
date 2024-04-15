<template >
    <div class="col-span-12 xl:col-span-12">
        <!-- Breadcrumb Start -->
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between" style="justify-content: flex-end">

            <nav>
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium cursor-pointer" @click = "this.$router.push('/service-categories')"> {{getName('service_types')}} /</a></li>
                    <li  class=" font-medium text-primary">{{getName('show')}}</li>
                </ol>
            </nav>
        </div>
        <div

            class="rounded-sm border mb-5 border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
            <h4 class="mb-6 text-xl font-bold text-black dark:text-white">
                {{item.name}}
            </h4>

            <table border="1" >

                <tr>
                    <th>{{getName('name_content')}}:</th>
                    <td>{{item.name}}</td>
                </tr>
                <tr>
                    <th>{{getName('status')}}:</th>
                    <td>{{item.status == 1 ? 'Active' : 'Inactive'}}</td>
                </tr>

            </table>

        </div>
        <ContentBox v-if="item.services != []">
            <ContentBlock v-for="(service, index) in item.services"
                :Title = "service.name"
                Text = " "
                          :Icon = "index+ 1"
                          Item = ""
                          @click = "this.$router.push( '/services')"
            />
        </ContentBox>
    </div>

</template>
<script>
import {useConterStore} from "../../../../store/counter.js";
import TableHeader from "./Table-header.vue";
import {service_categoryShow} from "../../../../Api.js";
import Table from "../Table.vue";
import Contents from "../../../../ui-components/Element/Contents.vue";
import ContentBox from "../../../../ui-components/Element/Contents/ContentBox.vue";
import ContentBlock from "../../../../ui-components/Element/Contents/ContentBlock.vue";

export default {
    components: {ContentBlock, ContentBox, Contents, Table, TableHeader},
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
            const response = await service_categoryShow(this.$route.query.id);
            console.log( response.data)
            this.item = response.data;

        },



    },
    mounted() {
        this.getItem()
    }
}
</script>
<style scoped >
    .fa-solid{cursor: pointer}
    table {
        border-collapse: separate;
        border-spacing: 30px; /* Masofani o'zgartiring */
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
    .contents{
        width: 100%;
        background: blueviolet;
        display: flex;
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
        ////color: #2E3A47 !important;

    }


</style>
