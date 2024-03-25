<template >
    <div class="col-span-12 xl:col-span-12">
        <!-- Breadcrumb Start -->
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between " style="justify-content: flex-end">

            <nav >
                <ol class="flex items-center gap-2">
                    <li><a class="font-medium cursor-pointer" @click = "this.$router.push('/product-documents')"> {{getName('Documents')}} /</a></li>
                    <li  class=" font-medium text-primary">{{getName('AddProduct')}}</li>
                </ol>
            </nav>
        </div>
        <Map01 Title = "" >
            <table class="table01 mt-5"  >

                <tr>
                    <th>{{getName('name_content')}} &nbsp;&nbsp;</th>
                    <th>{{getName('Warehouse')}} &nbsp;&nbsp;</th>
                    <th>{{getName('CreatedUser')}} &nbsp;&nbsp;</th>
                    <th>{{getName('Created_at')}}&nbsp;&nbsp;</th>
                    <th>{{getName('Supplier')}}&nbsp;&nbsp;</th>
                </tr>

                <tr>
                    <td>{{Name}} &nbsp;&nbsp;</td>
                    <td>{{Warehouse}}&nbsp;&nbsp;</td>
                    <td>{{User}} &nbsp;&nbsp;</td>
                    <td>{{created_at}} &nbsp;&nbsp;</td>
                    <td>{{Supplier}} &nbsp;&nbsp;</td>
                </tr>

            </table>
            <Loader v-if="Name == '' "  ></Loader>
        </Map01>

        <br>

        <ProductsTable @Created = "getItem()" v-if="Status != 13" :Header = "false" >

        </ProductsTable>

        <TableIndex v-if="Status == 13" ></TableIndex>


    </div>

</template>
<script>
import {useConterStore} from "../../../../store/counter.js";
import TableHeader from "./Table-header.vue";
import {productDocumentShow} from "../../../../Api.js";
import Contents from "../../../../ui-components/Element/Contents.vue";
import ContentBox from "../../../../ui-components/Element/Contents/ContentBox.vue";
import ContentBlock from "../../../../ui-components/Element/Contents/ContentBlock.vue";
import ProductsTable from "./Products/Table.vue";
import Payments from "../../Payments/Table.vue";
import Map01 from "../../../../ui-components/Element/map-01.vue";
import Loader from "@/ui-components/Element/Loader.vue";
import TableIndex from './Products/Table-index.vue'
export default {
    components: {Loader, Map01, ContentBlock, ContentBox, Contents, TableHeader, ProductsTable, Payments, TableIndex},
    data(){
        return{
            Patient: [],
            search: '',
            column: 'sort_order',
            order: 'asc',
            paginate: 10,
            pagination: {},
            current_page: 1,
            Document: null,
            Name: '',
            Warehouse: '',
            User: '',
            created_at: '',
            Supplier: '',
            Status: 0,
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
            const response = await productDocumentShow(this.$route.query.id);
            this.Name = response.data.name;
            this.Warehouse = response.data.warehouse;
            this.User = response.data.user;
            this.created_at = response.data.created_at;
            this.Supplier = response.data.supplier;
            this.Status = response.data.status;
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
        /* border-collapse: separate; */
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
        color: #2E3A47 !important;

    }


</style>
