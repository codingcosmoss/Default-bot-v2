<template>
    <Page Title="Mavzular">
        <div class="row">


            <BorderedTable>
                <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </BorderedTable>

        </div>

    </Page>
</template>
<script>
    import Page from "@/components/Layout/Page.vue";
    import {useConterStore} from "@/store/counter.js";
    import BorderedTable from "@/ui-components/Tables/BorderedTable.vue";

    export default {
        components:{BorderedTable, Page},
        data(){return{
            items: []
        }},
        methods:{

        },
        mounted(){
        }
    }
</script>
