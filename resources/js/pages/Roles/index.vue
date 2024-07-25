<template>
    <Page Title="">
        <div class="row"  >
            <BasicTable
                Modal="userCreate"
                :Th="[ $t('No'),$t('RoleName'),$t('Employees'),$t('CreatedAt'),$t('Settings')]"
                Title="All Roles"
                Col="col-lg-12"
                @onSearch="search($event)"
            >
                <template v-slot:inputs>
                    <DefaultInput
                        Class="col-lg-3 col-sm-2"
                        Label=""
                        Name="name"
                        Type="text"
                        Pholder="Search..."
                        @onInput="search($event)"
                    />
                </template>

                <template v-slot:buttons>
                    <PrimaryBtn @click="this.$router.push('/admin/roles/create')" role="button" >{{$t('Create')}}</PrimaryBtn>
                </template>
                <tr v-for="(item, i) in items" >
                    <td>{{i +1 }}</td>
                    <td>{{ item.name }}</td>
                    <td>
                       <div class="role_user_block">
                           <span v-if=" item.users.length == 0" class="badge badge-pill badge-soft-success font-size-12" style="margin-right: 4px">---</span>
                           <span v-if=" item.users.length > 0" v-for="user in item.users" @click="this.$router.push({path: '/admin/users/show', query:{id: user.id}})" class="badge badge-pill cursor-pointer badge-soft-success font-size-12" style="margin: 4px">{{user.name}}</span>
                       </div>
                    </td>
                    <td>{{ counterStore.formatDate(item.created_at) }}</td>
                    <td>
                        <PrimaryIconBtn @click="this.$router.push({path:'/admin/roles/update', query:{id:item.id}})" Icon="bx bx-edit-alt" />
                        <PrimaryIconBtn v-if="item.users.length == 0" @click="this.delete(item.id)" class="bg-danger border-danger" Icon="bx bx-trash-alt"/>

                    </td>
                </tr>

                <GrowingLoader v-if="loader" Cols="5"/>
            </BasicTable>
        </div>
    </Page>
</template>
<script>
    import Page from "@/components/layout/Page.vue";
    import {ApiError} from "@/helpers/Config.js";
    import {Alert} from "@/helpers/Config.js";
    import {useConterStore} from "@/store/counter.js";
    import {roles, roleUpdate, rolePaginates, roleDelete, roleShow ,roleSearch, roleCreate} from "../../helpers/api.js";
    import BasicTable from "@/components/all/BasicTable.vue";
    import PrimaryIconBtn from "@/components/all/PrimaryIconBtn.vue";
    import GrowingLoader from "@/components/all/GrowingLoader.vue";
    import PrimaryBtn from "@/components/all/PrimaryBtn.vue";
    import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";

    export default {
        components: {DefaultInput, PrimaryBtn, GrowingLoader, PrimaryIconBtn, BasicTable, Page},
        setup(){
            const counterStore = useConterStore();
            return{counterStore}
        },
        data(){return{
            items: [],
            item: [],
            paginateCount: 10,
            column: 'id',
            type: 'desc',
            errors: [],
            loader: false
        }},
        methods:{
            async index(){
                try {
                    this.loader = true;
                    const response = await roles();
                    this.items = response.data;
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async indexActives(){
                try {
                    this.loader = true;
                    const response = await roleActives(this.paginateCount);
                    this.items = response.data;
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async indexPaginates(){
                try {
                    this.loader = true;
                    const response = await rolePaginates(1000);
                    this.items = response.data.items;
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async orderBys(){
                try {
                    this.loader = true;
                    const response = await roleOrderBys(this.column, this.type);
                    this.items = response.data;
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async show(id){
                try {
                    const response = await roleShow(id);
                    this.item = response.data;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async create(){
                try {
                    let data = {
                        // ...
                    }
                    const response = await roleCreate(data);
                    if (response.status){
                        Alert('success', this.$t('create'));
                        return true;
                    }
                    this.errors = response.errors;
                    Alert('error', this.$t('formError'));
                    return false;
                }catch(error){
                    ApiError(this, error);
                    return false;
                }
            },
            async update(){
                try {
                    let data = {
                        // ...
                    }
                    const response = await roleUpdate(data);
                    if (response.status){
                        Alert('success', this.$t('update'));
                        return true;
                    }
                    this.errors = response.errors;
                    Alert('error', this.$t('formError'));
                    return false;
                }catch(error){
                    ApiError(this, error);
                    return false;
                }
            },
            async search(text = ''){
                try {
                    this.loader = true;
                    if (text == ''){
                        this.indexPaginates();
                        return true;
                    }
                    const response = await roleSearch(text);
                    this.items = response.data;
                    this.loader = false;
                    if (!response.status){
                        Alert('error', this.$t('formError'));
                        this.loader = false;
                        return false;
                    }
                    this.loader = false;
                    return true;
                }catch(error){
                    ApiError(this, error);
                    this.loader = false;
                    return false;
                }
            },
            async delete(id){
                try {
                    if (!confirm(this.$t('DeleteAlert'))){
                        return false;
                    }
                    const response = await roleDelete(id);
                    this.items = response.data;
                    if (response.status){
                        Alert('success', this.$t('delete'));
                        this.indexPaginates();
                    }
                    Alert('error', this.$t('formError'));
                    return false;
                }catch(error){
                    ApiError(this, error);
                    return false;
                }
            },
        },
        mounted() {
            this.indexPaginates()
        }
    }
</script>
<style>
    .role_user_block{
        display: flex;
        flex-wrap: wrap;
        max-width: 500px;
    }
</style>
