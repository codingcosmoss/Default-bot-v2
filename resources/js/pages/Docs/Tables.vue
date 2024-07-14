<template>
    <Page Title="Tables">

        <DocsRow Title="1. Basic Table">

            <BasicTable
                :Th="headers"
                Title="Latest Transaction"
                Col="col-lg-12"
            >
                <template v-slot:inputs>
                    <DefaultInput
                        Class="col-lg-3 col-sm-2 search_input"
                        Label=""
                        Name="name"
                        Type="text"
                        Pholder="Search..."
                        @onInput="search($event)"
                    />

                    <DefaultSelect
                        Label=""
                        Class="col-lg-2 col-sm-2"
                        @onInput="this.paginateCount = $event, this.indexPaginates()"
                    >
                        <option value="10" selected >{{$t('NumberDownloads')}}</option>
                        <option value="10" >10</option>
                        <option value="20" >20</option>
                        <option value="50" >50</option>
                        <option value="100" >100</option>
                    </DefaultSelect>
                </template>
                <template v-slot:buttons>
                    <PrimaryBtn v-if="counterStore.hasRole('public')" role="button" data-bs-toggle="modal" data-bs-target="#userCreate" >{{$t('Create')}}</PrimaryBtn>
                </template>

                <tr v-for="item in tableItems3" >

                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.date }}</td>
                    <td>{{ item.total }}</td>
                    <td>
                        <PrimaryIconBtn v-if="counterStore.hasRole('public')" @click="this.item = item" Icon="bx bx-edit-alt" Modal="userUpdate"/>&nbsp;
                        <PrimaryIconBtn  @click="this.$router.push({path:'path', query:{id: item.id}})" Icon="bx bx-show"/>&nbsp;
                        <PrimaryIconBtn v-if="counterStore.hasRole('public')" @click="this.delete(item.id)" class="bg-danger border-danger" Icon="bx bx-trash-alt"/>
                    </td>
                </tr>
                <Paginate
                    v-if="last_page != 1"
                    :currentPage="this.current_page"
                    :totalPages="this.last_page"
                    @changePage="indexPaginates($event)"
                />
                <GrowingLoader v-if="loader" :Cols="headers.length()"/>
            </BasicTable>

            <PregBox No="1"
                     Codes=" &lt;BasicTable
                :Th=&quot;headers&quot;
                Title=&quot;Latest Transaction&quot;
                Col=&quot;col-lg-12&quot;
            &gt;
                &lt;template v-slot:inputs&gt;
                    &lt;DefaultInput
                        Class=&quot;col-lg-3 col-sm-2 search_input&quot;
                        Label=&quot;&quot;
                        Name=&quot;name&quot;
                        Type=&quot;text&quot;
                        Pholder=&quot;Search...&quot;
                        @onInput=&quot;search($event)&quot;
                    /&gt;

                    &lt;DefaultSelect
                        Label=&quot;&quot;
                        Class=&quot;col-lg-2 col-sm-2&quot;
                        @onInput=&quot;this.paginateCount = $event, this.indexPaginates()&quot;
                    &gt;
                        &lt;option value=&quot;10&quot; selected &gt;{{$t('NumberDownloads')}}&lt;/option&gt;
                        &lt;option value=&quot;10&quot; &gt;10&lt;/option&gt;
                        &lt;option value=&quot;20&quot; &gt;20&lt;/option&gt;
                        &lt;option value=&quot;50&quot; &gt;50&lt;/option&gt;
                        &lt;option value=&quot;100&quot; &gt;100&lt;/option&gt;
                    &lt;/DefaultSelect&gt;
                &lt;/template&gt;
                &lt;template v-slot:buttons&gt;
                    &lt;PrimaryBtn v-if=&quot;counterStore.hasRole('public')&quot; role=&quot;button&quot; data-bs-toggle=&quot;modal&quot; data-bs-target=&quot;#userCreate&quot; &gt;{{$t('Create')}}&lt;/PrimaryBtn&gt;
                &lt;/template&gt;

                &lt;tr v-for=&quot;item in items&quot; &gt;

                    &lt;td&gt;{{ item.id }}&lt;/td&gt;
                    &lt;td&gt;{{ item.name }}&lt;/td&gt;
                    &lt;td&gt;{{ item.date }}&lt;/td&gt;
                    &lt;td&gt;{{ item.total }}&lt;/td&gt;
                    &lt;td&gt;
                        &lt;PrimaryIconBtn v-if=&quot;counterStore.hasRole('public')&quot; @click=&quot;this.item = item&quot; Icon=&quot;bx bx-edit-alt&quot; Modal=&quot;userUpdate&quot;/&gt;&amp;nbsp;
                        &lt;PrimaryIconBtn  @click=&quot;this.$router.push({path:'path', query:{id: item.id}})&quot; Icon=&quot;bx bx-show&quot;/&gt;&amp;nbsp;
                        &lt;PrimaryIconBtn v-if=&quot;counterStore.hasRole('public')&quot; @click=&quot;this.delete(item.id)&quot; class=&quot;bg-danger border-danger&quot; Icon=&quot;bx bx-trash-alt&quot;/&gt;
                    &lt;/td&gt;
                &lt;/tr&gt;
                &lt;Paginate
                    v-if=&quot;last_page != 1&quot;
                    :currentPage=&quot;this.current_page&quot;
                    :totalPages=&quot;this.last_page&quot;
                    @changePage=&quot;indexPaginates($event)&quot;
                /&gt;
                &lt;GrowingLoader v-if=&quot;loader&quot; :Cols=&quot;headers.length()&quot;/&gt;
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
import DefaultSelect from "@/ui-components/Forms/DefaultSelect.vue";
import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
import PrimaryIconBtn from "@/components/all/PrimaryIconBtn.vue";
import {useConterStore} from "@/store/counter.js";
import Paginate from "@/components/all/Paginate.vue";
import GrowingLoader from "@/components/all/GrowingLoader.vue";
import PrimaryBtn from "@/components/all/PrimaryBtn.vue";

export default {
    setup(){
        const counterStore = useConterStore();
        return{counterStore}
    },
    components: {
        PrimaryBtn,
        GrowingLoader, Paginate, PrimaryIconBtn, DefaultInput, DefaultSelect, BasicTable, PregBox, Page,DocsRow},
    data(){return{
        tableItems3:[
            {
                id: 1,
                name: 'Neal Matthews',
                date: '2023-21-21',
                total: '100,00 uzs',
                status: 'active',
                headers:['Order ID', 'Billing Name', 'Date', 'Payment Status','Settings', ]
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
