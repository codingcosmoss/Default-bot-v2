<template>
    <Page Title="">
        <div class="row"  >
            <BaseBox Col="col-xl-6" :Title="$t('UserInfo')">
                <ImageInput
                    :Title="$t('ProfilPhoto')"
                    Name="ProfilImage"
                    @ProfilImage="image = $event,  delete this.errors.image"
                    :Image="image"
                    :Validated="errors"
                />

                <DefaultInput
                    :Label="$t('Name')"
                    Name="name"
                    Type="text"
                    :Validated="errors"
                    :Value="name"
                    @onInput="name = $event,  delete this.errors.name"
                />
                <DefaultInput
                    :Label="$t('Login')"
                    Name="login"
                    Type="text"
                    :Validated="errors"
                    :Value="login"
                    @onInput="login = $event,  delete this.errors.login"
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

            <BaseBox Col="col-xl-6" :Title="$t('UpdatePassword')">
                <DefaultInput
                    :Label="$t('Password')"
                    Name="password"
                    Type="password"
                    :Validated="passwordErrors"
                    :Value="password"
                    @onInput="password = $event,  delete this.passwordErrors.password"
                />
                <DefaultInput
                    :Label="$t('RepeatPassword')"
                    Name="password"
                    Type="password"
                    :Value="repeatPassword"
                    :Validated="passwordErrors"
                    @onInput="repeatPassword = $event,  delete this.passwordErrors.password"
                />

                <PrimaryButton :Loader="loaderPass" @onButton="updatePassword">{{$t('Save')}}</PrimaryButton>
            </BaseBox>

        </div>
    </Page>
</template>
<script>
import Page from "@/components/layout/Page.vue";
import {ApiError} from "@/helpers/Config.js";
import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
import {users, userProfilUpdate, userSearch, userUpdate, userShow, userDelete, userPaginates, userActives, userOrderBys, userUpdatePassword} from "../../helpers/api.js";
import PrimaryButton from "@/components/all/PrimaryButton.vue";
import {Alert} from "@/helpers/Config.js";
import ImageInput from "@/components/all/ImageInput.vue";
import {useConterStore} from "@/store/counter.js";

export default {
    components: {ImageInput, PrimaryButton, DefaultInput, Page},
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
        passwordErrors: [],
        loader: false,
        loaderPass: false,
        // forms
        name: "",
        login: '',
        phone:'',
        email: '',
        image: '',
        password: '',
        repeatPassword: ''
    }},
    methods:{
        async index(){
            try {
                const response = await users();
                this.items = response.data;
            }catch(error){
                ApiError(this, error);
            }
        },
        async indexActives(){
            try {
                const response = await userActives(this.paginateCount);
                this.items = response.data;
            }catch(error){
                ApiError(this, error);
            }
        },
        async indexPaginates(){
            try {
                const response = await userPaginates(this.paginateCount);
                this.items = response.data;
            }catch(error){
                ApiError(this, error);
            }
        },
        async orderBys(){
            try {
                const response = await userOrderBys(this.column, this.type);
                this.items = response.data;
            }catch(error){
                ApiError(this, error);
            }
        },
        async show(id){
            try {
                const response = await userShow(id);
                this.item = response.data;
                this.name = response.data.name;
                this.login = response.data.login;
                this.email = response.data.email;
                this.phone = response.data.phone;
                this.image = response.data.image[0].url;
                localStorage.setItem('user', JSON.stringify(response.data))
                this.counterStore.updateUser(response.data)
            }catch(error){
                ApiError(this, error);
            }
        },
        async update(){
            try {
                this.loader = true;
                let data = {
                    name: this.name,
                    phone: this.phone,
                    login: this.login,
                    position: this.item.position,
                    email: this.email,
                    image: this.image,
                    role_id: this.item.role_id,
                }
                console.log('Data', data)
                const response = await userProfilUpdate(this.item.id , data);
                if (response.status){
                    Alert('success', this.$t('update'));
                    this.show(response.data.id);
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
        async updatePassword(){
            try {
                this.loaderPass = true;
                if (this.password.length > 0 && this.password != this.repeatPassword){
                    this.passwordErrors = {password: this.$t('RepeatPasswordAlert')};
                    return false;
                }
                let data = {
                    password: this.password,
                }
                const response = await userUpdatePassword(this.item.id , data);
                console.log(response)
                if (response.status){
                    Alert('success', this.$t('update'));
                    this.password = '';
                    this.repeatPassword = '';
                    this.loaderPass = false;
                    return true;
                }
                this.passwordErrors = response.errors;
                Alert('error', this.$t('formError'));
                this.loaderPass = false;
                return false;
            }catch(error){
                ApiError(this, error);
                this.loaderPass = false;
                return false;
            }
        },
        async search(text = ''){
            try {
                const response = await userSearch(text);
                this.items = response.data;
                if (!response.status){
                    Alert('error', this.$t('formError'));
                    return false;
                }
                return true;
            }catch(error){
                ApiError(this, error);
                return false;
            }
        },
        async delete(id){
            try {
                const response = await userDelete(id);
                this.items = response.data;
                if (response.status){
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
        this.show(JSON.parse(localStorage.getItem('user'))['id'])
    }
}
</script>
<style></style>
