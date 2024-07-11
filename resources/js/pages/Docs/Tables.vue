<template>
    <Page Title="Tables">

        <DocsRow Title="1. Basic Table">

            <BasicTable
                :Th="['Order ID', 'Billing Name', 'Date', 'Total', 'Payment Status']"
                Title="Latest Transaction"
                Col="col-lg-12"
            >
                <tr v-for="item in tableItems3" >
                    <td>
                        <BaseCheck
                            Title=""
                            :isCheck="false"
                        />
                    </td>
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.date }}</td>
                    <td>{{ item.total }}</td>
                    <td>{{ item.status }}</td>
                </tr>
            </BasicTable>

            <PregBox No="1"
                     Codes=" &lt;BasicTable
                :Th=&quot;['Order ID', 'Billing Name', 'Date', 'Total', 'Payment Status']&quot;
                Title=&quot;Latest Transaction&quot;
                Col=&quot;col-lg-12&quot;
                &gt;
                &lt;tr v-for=&quot;item in tableItems3&quot; &gt;
                    &lt;td&gt;
                        &lt;BaseCheck
                            Title=&quot;&quot;
                            :isCheck=&quot;false&quot;
                        /&gt;
                    &lt;/td&gt;
                    &lt;td&gt;{{ item.id }}&lt;/td&gt;
                    &lt;td&gt;{{ item.name }}&lt;/td&gt;
                    &lt;td&gt;{{ item.date }}&lt;/td&gt;
                    &lt;td&gt;{{ item.total }}&lt;/td&gt;
                    &lt;td&gt;{{ item.status }}&lt;/td&gt;
                &lt;/tr&gt;
            &lt;/BasicTable&gt;"
            />

        </DocsRow>



    </Page>
</template>
<script>
import Page from "@/components/layout/Page.vue";
import CardBlock from "@/components/all/CardBlock.vue";
import DocsRow from "@/components/all/DocsRow.vue";
import PregBox from "@/components/all/PregBox.vue";
import CardClassicBlock from "@/components/all/CardClassicBlock.vue";
import BasicTable from "@/components/all/BasicTable.vue";

export default {
    components: {BasicTable, PregBox, Page,DocsRow},
    data(){return{
        tableItems3:[
            {
                id: 1,
                name: 'Neal Matthews',
                date: '2023-21-21',
                total: '100,00 uzs',
                status: 'active'
            },
            {
                id: 2,
                name: 'Neal Matthews',
                date: '2023-21-21',
                total: '100,00 uzs',
                status: 'active'
            }
        ]
    }}
}
</script>
