<template>
    <!--    Modal   -->
    <ModalCentered :Title="$t('Update')" ModalName="userUpdate" ModalTypes="modal-xl" :isModalFooter="false">
        <div class="row"  >
            <BaseBox Col="col-xl-6" :Title="$t('UserInfo')">

                <ImageInput
                    :Title="$t('ProfilPhoto')"
                    Name="userUpdateImage"
                    @userUpdateImage="image = $event, delete this.errors.image"
                    :Image="image"
                    :Validated="errors"
                />

                <div class="row">
                    <DefaultInput
                        :Label="$t('Name')"
                        Name="name"
                        Type="text"
                        :Validated="errors"
                        :Value="name"
                        @onInput="name = $event,  delete this.errors.name"
                        Class="col-lg-6 col-sm-12"
                    />
                    <DefaultInput
                        :Label="$t('Login')"
                        Name="login"
                        Type="text"
                        :Validated="errors"
                        :Value="login"
                        Class="col-lg-6 col-sm-12"
                        @onInput="login = $event,  delete this.errors.login"
                    />
                </div>

                <div class="row">
                    <DefaultInput
                        :Label="$t('Phone')"
                        Name="phone"
                        Type="text"
                        :Validated="errors"
                        :Value="phone"
                        Class="col-lg-6 col-sm-12"
                        @onInput="phone = $event,  delete this.errors.phone"
                    />
                    <DefaultInput
                        :Label="$t('Email')"
                        Label="Email"
                        Name="email"
                        Type="text"
                        :Validated="errors"
                        :Value="email"
                        Class="col-lg-6 col-sm-12"
                        @onInput="email = $event,  delete this.errors.email"
                    />
                </div>

                <div class="row">
                    <DefaultInput
                        :Label="$t('Position')"
                        Name="position"
                        Type="text"
                        :Validated="errors"
                        :Value="position"
                        @onInput="position = $event,  delete this.errors.position"
                        Class="col-lg-6 col-sm-12"
                    />
                    <DefaultSelect
                        :Label="$t('SystemRole')"
                        Name="role"
                        Type="text"
                        :Validated="errors"
                        :Value="role"
                        @onInput="role = $event,  delete this.errors.role"
                        Class="col-lg-6 col-sm-12"
                    >
                        <option v-for="role in roles" :selected="item.role_id == role.id" :value="role.id" >{{role.name}}</option>
                    </DefaultSelect>
                </div>
                <div class="row">
                    <DefaultInput
                        :Label="$t('Payable') + ' (' +sign+ ')'"
                        Name="payable"
                        Type="text"
                        :Validated="errors"
                        :Value="this.counterStore.formatNumber(payable)"
                        @onInput="onPayable($event),  delete this.errors.payable"
                        Class="col-lg-6 col-sm-12 payable"
                    />

                    <DefaultInput
                        :Label="$t('Due') + ' (' +$t('Day')+ ')'"
                        Name="due"
                        Type="number"
                        :Validated="errors"
                        :Value="due"
                        @onInput="due = $event,  delete this.errors.due"
                        Class="col-lg-6 col-sm-12"
                    />
                </div>


                <BtnBox>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ $t('Close') }}</button>&nbsp;&nbsp;
                    <PrimaryBtn  :Loader="loader" @onButton="update">{{$t('Save')}}</PrimaryBtn>
                </BtnBox>


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
                <BtnBox>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ $t('Close') }}</button>&nbsp;&nbsp;
                    <PrimaryBtn   :Loader="loaderPass" @onButton="updatePassword">{{$t('Save')}}</PrimaryBtn>
                </BtnBox>
            </BaseBox>

        </div>
    </ModalCentered>
</template>
<script>
import Page from "@/components/layout/Page.vue";
import {ApiError} from "@/helpers/Config.js";
import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
import {
    users,
    userCreate,
    userSearch,
    userUpdate,
    userShow,
    userDelete,
    userPaginates,
    userActives,
    userOrderBys,
    userUpdatePassword,
    roles
} from "../../helpers/api.js";
import PrimaryButton from "@/components/all/PrimaryButton.vue";
import {Alert} from "@/helpers/Config.js";
import ImageInput from "@/components/all/ImageInput.vue";
import {useConterStore} from "@/store/counter.js";
import ModalCentered from "@/components/all/ModalCentered.vue";
import BtnBox from "@/components/all/BtnBox.vue";
import PrimaryBtn from "@/components/all/PrimaryBtn.vue";
import DefaultSelect from "@/ui-components/Forms/DefaultSelect.vue";

export default {
    components: {DefaultSelect, PrimaryBtn, BtnBox, ModalCentered, ImageInput, PrimaryButton, DefaultInput, Page},
    setup() {
        const counterStore = useConterStore();
        return {counterStore}
    },
    props:{
        Item: Object
    },
    data() {
        return {
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
            phone: '',
            email: '',
            image: '',
            password: '',
            repeatPassword: '',
            position: '',
            role: '',
            payable: 0,
            due: 0,
            roles: [],
            sign: ''
        }
    },
    methods: {
        async roleIndex(){
            try {
                this.loader = true;
                const response = await roles();
                this.roles = response.data;
                this.loader = false;
            }catch(error){
                ApiError(this, error);
            }
        },
        onPayable(val){
            this.payable = this.counterStore.inputNumberFormat('payable',this.payable, val);
        },
        async show(id) {
            try {
                const response = await userShow(id);
                this.item = response.data;
                this.name = response.data.name;
                this.login = response.data.login;
                this.email = response.data.email;
                this.phone = response.data.phone;
                this.position = response.data.position;
                this.role = response.data.role_id;
                this.payable = this.counterStore.formatNumber(response.data.payable);
                this.due = response.data.due;
                this.image = response.data.image[0].url;
                if (this.item.id == this.counterStore.user.id){
                    localStorage.setItem('user', JSON.stringify(response.data))
                    this.counterStore.updateUser(response.data)
                }
            } catch (error) {
                ApiError(this, error);
            }
        },
        async save() {
            try {
                console.log(this.Item)
                this.sign = this.counterStore.user.currency.sign
                this.item = this.Item;
                this.name = this.Item.name;
                this.login = this.Item.login;
                this.email = this.Item.email;
                this.phone = this.Item.phone;
                this.role = this.Item.role_id;
                this.position = this.Item.position;
                this.payable = this.Item.payable;
                this.due = this.Item.due;
                this.image = this.Item.image[0].url;
                if (this.item.id == this.counterStore.user.id){
                    localStorage.setItem('user', JSON.stringify(response.data))
                    this.counterStore.updateUser(response.data)
                }
            } catch (error) {
                ApiError(this, error);
            }
        },
        discharge() {
            this.item = '';
            this.name = '';
            this.login = '';
            this.email = '';
            this.phone = '';
            this.image = '';
            this.payable = 0;
            this.due = 0;
            this.password = '';
            this.repeatPassword = '';
            this.position = '';
            this.role = '';

        },
        async update() {
            try {
                this.loader = true;
                let data = {
                    name: this.name,
                    phone: this.phone,
                    login: this.login,
                    email: this.email,
                    image: this.image,
                    role_id: this.role,
                    payable: this.payable,
                    due: this.due,
                    position: this.position,
                }
                const response = await userUpdate(this.item.id, data);
                if (response.status) {
                    Alert('success', this.$t('update'));
                    this.$emit('onUpdate', true)
                    this.counterStore.hiddenModal('userUpdate');
                    this.loader = false;
                    this.discharge()
                    this.show(response.data.id);
                    return true;
                }
                this.errors = response.errors;
                Alert('error', this.$t('formError'));
                this.loader = false;
                return false;
            } catch (error) {
                ApiError(this, error);
                this.loader = false;
                return false;
            }
        },
        async updatePassword() {
            try {
                this.loaderPass = true;
                if (this.password.length > 0 && this.password != this.repeatPassword) {
                    this.passwordErrors = {password: this.$t('RepeatPasswordAlert')};
                    return false;
                }
                let data = {
                    password: this.password,
                }
                const response = await userUpdatePassword(this.Item.id, data);
                console.log(response)
                if (response.status) {
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
            } catch (error) {
                ApiError(this, error);
                this.loaderPass = false;
                return false;
            }
        },
    },
    mounted() {
        this.save()
        this.roleIndex()
    },
    watch: {
        Item: function(newVal, oldVal) { // watch it
            this.save()
        }
    }
}
</script>
<style></style>
