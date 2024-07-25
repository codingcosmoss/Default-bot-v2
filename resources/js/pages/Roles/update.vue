<template>
    <Page Title="">
        <div class="row"  >

            <div class="col-xl-12">
                <BaseBox Col="col-xl-6" :Title="$t('Update')" >
                    <DefaultInput
                        :Label="$t('RoleName')"
                        Name="name"
                        Type="text"
                        :Validated="errors"
                        :Value="name"
                        @onInput="name = $event,  delete this.errors.name"
                    />

                </BaseBox>
            </div>
            <BaseBox Col="col-xl-6"  :Title="$t('Permissions')"  >
                <BaseCheck
                    @click="addAllPermission()"
                    :isCheck="isAll"
                    :Title="$t('MarkAll')"
                />
                <br>
                <PrimaryTable
                    :Th="[ $t('Sections'), $t('Permissions')]"
                    Title="Latest Transaction"
                    Col="col-lg-12"
                >
                    <tr v-for="menu in items.slice(0, items.length/2)">
                        <td> <BaseCheck :Title="$t(menu.name)" @click="addMenu(menu)" :isCheck="this.menus.find(id => id == menu.id)" /> </td>
                        <td class="text-primary">
                            <BaseCheck
                                v-for="permission in menu.permissions"
                                @click="addPermission(permission)"
                                :isCheck="this.permissions.find(id => id == permission.id)"
                                :Title="$t(permission.name.toUpperCase())"
                            />
                        </td>
                    </tr>
                </PrimaryTable>
            </BaseBox>
            <BaseBox Col="col-xl-6"  Title=""  >
                <h4 class="card-title mb-4 d-none d-xl-block">&nbsp;</h4>
                <div class="m-xl-5" ></div>
                <br>
                <PrimaryTable
                    :Th="[ $t('Sections'), $t('Permissions')]"
                    Title="Latest Transaction"
                    Col="col-lg-12"
                >
                    <tr v-for="menu in items.slice(items.length/2, items.length)">
                        <td> <BaseCheck :Title="$t(menu.name)" @click="addMenu(menu)" :isCheck="this.menus.find(id => id == menu.id)" /> </td>
                        <td class="text-primary">
                            <BaseCheck
                                v-for="permission in menu.permissions"
                                @click="addPermission(permission)"
                                :isCheck="this.permissions.find(id => id == permission.id)"
                                :Title="$t(permission.name.toUpperCase())"
                            />
                        </td>
                    </tr>
                </PrimaryTable>
                <br>
                <BtnBox>
                    <PrimaryBtn class="btn btn-secondary" @click="this.$router.go(-1)"  >{{ $t('Close') }}</PrimaryBtn>&nbsp;&nbsp;
                    <PrimaryBtn @click="update()" :Loader="loader" >{{ $t('Save') }}</PrimaryBtn>
                </BtnBox>
            </BaseBox>

        </div>
    </Page>
</template>
<script>
    import Page from "@/components/layout/Page.vue";
    import {ApiError} from "@/helpers/Config.js";
    import {Alert} from "@/helpers/Config.js";
    import {useConterStore} from "@/store/counter.js";
    import {menus, roleUpdate, rolePaginates, roleDelete, roleShow ,roleSearch, roleCreate} from "../../helpers/api.js";
    import BasicTable from "@/components/all/BasicTable.vue";
    import PrimaryIconBtn from "@/components/all/PrimaryIconBtn.vue";
    import GrowingLoader from "@/components/all/GrowingLoader.vue";
    import PrimaryBtn from "@/components/all/PrimaryBtn.vue";
    import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
    import BtnBox from "@/components/all/BtnBox.vue";
    import PrimaryTable from "@/components/all/PrimaryTable.vue";
    import BaseCheck from "@/components/global/BaseCheck.vue";

    export default {
        components: {
            BaseCheck,
            PrimaryTable, BtnBox, DefaultInput, PrimaryBtn, GrowingLoader, PrimaryIconBtn, BasicTable, Page},
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
            loader: false,
            menus: [],
            // Forms
            permissions: [],
            isAll: false,
            name: ''
        }},
        methods:{
            async index(){
                try {
                    this.loader = true;
                    const response = await menus();
                    this.items = response.data;
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async show(id){
                try {
                    const response = await roleShow(this.$route.query.id);
                    this.item = response.data;
                    this.name = response.data.name;
                    response.data.permissions.forEach(permission => {
                        this.permissions.push(permission.id);
                        this.menus.push(permission.menu_id);
                    })

                }catch(error){
                    ApiError(this, error);
                }
            },
            async create(){
                try {
                    this.loader = true;
                    let data = {
                        name: this.name,
                        permissions: this.permissions
                    }
                    const response = await roleCreate(data);
                    if (response.status){
                        Alert('success', this.$t('create'));
                        this.loader = false;
                        this.$router.push('/admin/roles');
                        return true;
                    }
                    this.errors = response.errors;
                    this.loader = false;
                    Alert('error', this.$t('formError'));
                    return false;
                }catch(error){
                    ApiError(this, error);
                    this.loader = false;
                    return false;
                }
            },
            async update(){
                try {
                    this.loader = true;
                    let data = {
                        name: this.name,
                        permissions: this.permissions
                    }
                    const response = await roleUpdate(this.$route.query.id, data);
                    console.log(response);
                    if (response.status){
                        this.$router.push('/admin/roles');
                        Alert('success', this.$t('update'));
                        this.loader = false;
                        return true;
                    }
                    this.errors = response.errors;
                    Alert('error', this.$t('formError'));
                    this.loader = false;
                    return false;
                }catch(error){
                    ApiError(this, error);
                    this.loader = false;
                    return false;
                }
            },
            // ----------- Personal function
            addPermission(permission){
                let isData = this.permissions.find(item => item == permission.id);
                if (isData){
                    this.permissions = this.permissions.filter(item => item != permission.id);
                }else {
                    this.menus.push(permission.menu_id);
                    this.permissions.push(permission.id);
                }
            },
            addAllPermission(){
                this.isAll = !this.isAll;
                if (this.isAll){
                    this.menus = [];
                    this.permissions = [];
                    this.items.forEach(menu => {
                        this.menus.push(menu.id)
                        menu.permissions.forEach(e =>{
                            this.permissions.push(e.id);
                        })
                    })
                }else {
                    this.menus = [];
                    this.permissions = [];
                }
                console.log('Uzenligi:', this.menus.length)
            },
            addMenu(menu){
                let isData = this.menus.find(item => item == menu.id);
                if (isData) {
                    this.menus = this.menus.filter(item => item != menu.id);
                    this.permissions = this.permissions.filter(permission => {
                        return !menu.permissions.find(item => item.id == permission);
                    });
                } else {
                    this.menus.push(menu.id);
                    menu.permissions.forEach(permission => {
                        if (!this.permissions.includes(permission.id)) {
                            this.permissions.push(permission.id);
                        }
                    });
                }

            }
        },
        mounted() {
            this.index();
            this.show();
        }
    }
</script>
<style></style>
