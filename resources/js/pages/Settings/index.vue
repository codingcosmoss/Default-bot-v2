<template>
    <Page Title="">
        <div class="row"  >

            <BaseBox Col="col-xl-6" :Title="$t('CompanySettings')">
                <ImageInput
                    :Title="$t('CompanyLogo')"
                    Name="CompanyLogo"
                    @CompanyLogo="image = $event,  delete this.errors.image"
                    :Image="image"
                    :Validated="errors"
                />

                <DefaultInput
                    :Label="$t('CompanyName')"
                    Name="name"
                    Type="text"
                    :Validated="errors"
                    :Value="name"
                    @onInput="name = $event,  delete this.errors.name"
                />
                <DefaultInput
                    :Label="$t('Address')"
                    Name="address"
                    Type="text"
                    :Validated="errors"
                    :Value="address"
                    @onInput="address = $event,  delete this.errors.address"
                />
                <DefaultInput
                    :Label="$t('Phone')"
                    Name="phone"
                    Type="text"
                    :Validated="errors"
                    :Value="phone"
                    @onInput="phone = $event,  delete this.errors.phone"
                />
                <DefaultInput
                    :Label="$t('Email')"
                    Label="Email"
                    Name="email"
                    Type="text"
                    :Validated="errors"
                    :Value="email"
                    @onInput="email = $event,  delete this.errors.email"
                />

                <PrimaryButton :Loader="loader" @onButton="update">{{$t('Save')}}</PrimaryButton>
            </BaseBox>

            <BaseBox Col="col-xl-6" :Title="$t('ProgramSettings')">

                <DefaultSelect
                    :Label="$t('Currency')"
                    Name="currency_id"
                    @onInput="currency_id = $event,  delete this.errors.currency_id"
                    :Validated="errors"
                >
                    <option v-for="currency in currencies" :selected="currency.id == currency_id" :value="currency.id" >{{currency.title}} ({{currency.sign}})</option>
                </DefaultSelect>

                <PrimaryButton :Loader="loader" @onButton="update">{{$t('Save')}}</PrimaryButton>

            </BaseBox>
        </div>
    </Page>
</template>
<script>
    import Page from "@/components/layout/Page.vue";
    import {ApiError} from "@/helpers/Config.js";
    import {Alert} from "@/helpers/Config.js";
    import {useConterStore} from "@/store/counter.js";
    import ImageInput from "@/components/all/ImageInput.vue";
    import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
    import PrimaryBtn from "@/components/all/PrimaryBtn.vue";
    import PrimaryButton from "@/components/all/PrimaryButton.vue";
    import {
        settings,
        settingDelete,
        settingActives,
        settingCreate,
        settingShow,
        settingUpdate,
        settingPaginates,
        currencys
    } from "../../helpers/api.js";
    import DefaultSelect from "@/ui-components/Forms/DefaultSelect.vue";

    export default {
        components: {DefaultSelect, PrimaryButton, PrimaryBtn, DefaultInput, ImageInput, Page},
        setup(){
            const counterStore = useConterStore();
            return{counterStore}
        },
        data(){return{
            items: [],
            item: [],
            paginateCount: 10,
            last_page: 1,
            current_page: 1,
            column: 'id',
            type: 'desc',
            errors: [],
            headers: [],
            loader: false,
            // forms
            image: '',
            name: '',
            phone: '',
            email:'',
            address: '',
            currency_id: '',
            currencies: []
        }},
        methods:{
            async index(){
                try {
                    this.loader = true;
                    const response = await settings();
                    this.items = response.data;
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async getCurrencies(){
                try {
                    this.loader = true;
                    const response = await currencys();
                    this.currencies = response.data;
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async indexActives(){
                try {
                    this.loader = true;
                    const response = await settingActives(this.paginateCount);
                    this.items = response.data;
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async indexPaginates(page=1){
                try {
                    this.loader = true;
                    const response = await settingPaginates(this.paginateCount, page);
                    this.current_page = response.data.pagination.current_page;
                    this.last_page = response.data.pagination.last_page;
                    this.items = response.data.items;
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async orderBys(){
                try {
                    this.loader = true;
                    const response = await settingOrderBys(this.column, this.type);
                    this.items = response.data;
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async show(id){
                try {
                    this.loader = true;
                    const response = await settingShow(this.counterStore.user.clinic_id);
                    this.item = response.data;
                    this.name = response.data.name;
                    this.address = response.data.address;
                    this.email = response.data.email;
                    this.phone = response.data.phone;
                    this.currency_id = response.data.currency_id;
                    this.image = response.data.image[0].url;
                    this.loader = false;
                }catch(error){
                    ApiError(this, error);
                }
            },
            async create(){
                try {
                    this.loader = true;
                    let data = {
                        // ...
                    }
                    const response = await settingCreate(data);
                    if (response.status){
                        Alert('success', this.$t('create'));
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
            async update(){
                try {
                    this.loader = true;
                    let data = {
                        name: this.name,
                        address: this.address,
                        email: this.email,
                        phone: this.phone,
                        currency_id: this.currency_id,
                        image: this.image
                    }
                    const response = await settingUpdate(1, data);
                    if (response.status){
                        Alert('success', this.$t('update'));
                        this.counterStore.updateCurrency(response.data.currency)
                        this.show(1);
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
            async search(text = ''){
                try {
                    this.loader = true;
                    if (text == ''){
                        this.indexPaginates();
                        return true;
                    }
                    const response = await settingSearch(text);
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
                    const response = await settingDelete(id);
                    this.items = response.data;
                    if (response.status){
                        this.indexPaginates()
                        Alert('success', this.$t('delete'));
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
            this.getCurrencies();
            this.show(null)
        }
    }
</script>
<style></style>
