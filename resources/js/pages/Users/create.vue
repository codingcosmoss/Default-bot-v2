<template>
    <!--    Modal   -->
    <ModalCentered :Title="$t('Create')" ModalName="userCreate" ModalTypes="modal-xl" :isModalFooter="false">
        <div class="row"  >
            <BaseBox Col="col-xl-6" :Title="$t('UserInfo')">


                <ImageInput
                    :Title="$t('ProfilPhoto') + '1'"
                    Name="createImage"
                    @createImage="image = $event, delete this.errors.image"
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
                        @onInput="login = $event,  delete this.errors.login"
                        Class="col-lg-6 col-sm-12"
                    />
                </div>

                <div class="row">
                    <DefaultInput
                        :Label="$t('Phone')"
                        Name="phone"
                        Type="text"
                        :Validated="errors"
                        :Value="phone"
                        @onInput="phone = $event,  delete this.errors.phone"
                        Class="col-lg-6 col-sm-12"
                    />
                    <DefaultInput
                        :Label="$t('Email')"
                        Label="Email"
                        Name="email"
                        Type="text"
                        :Validated="errors"
                        :Value="email"
                        @onInput="email = $event,  delete this.errors.email"
                        Class="col-lg-6 col-sm-12"
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
                        Name="role_id"
                        Type="text"
                        :Validated="errors"
                        :Value="role"
                        @onInput="role = $event,  delete this.errors.role_id"
                        Class="col-lg-6 col-sm-12"
                    >
                        <option  selected >---</option>
                        <option v-for="role in roles"  :value="role.id" >{{role.name}}</option>
                    </DefaultSelect>


                </div>



            </BaseBox>

            <BaseBox Col="col-xl-6" Title="" >
                <DefaultInput
                    :Label="$t('Password')"
                    Name="password"
                    Type="password"
                    :Validated="errors"
                    :Value="password"
                    @onInput="password = $event,  delete this.errors.password"
                />
                <DefaultInput
                    :Label="$t('RepeatPassword')"
                    Name="password"
                    Type="password"
                    :Value="repeatPassword"
                    :Validated="errors"
                    @onInput="repeatPassword = $event,  delete this.errors.password"
                />
                <BtnBox>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ $t('Close') }}</button>&nbsp;&nbsp;
                    <PrimaryBtn  :Loader="loader" @onButton="create">{{$t('Save')}}</PrimaryBtn>
                </BtnBox>
            </BaseBox>

        </div>
    </ModalCentered>
</template>
<script>
import Page from "@/components/layout/Page.vue";
import {ApiError} from "@/helpers/Config.js";
import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
import {users, userCreate, userSearch, roles, userUpdate, userShow, userDelete, userPaginates, userActives, userOrderBys, userUpdatePassword} from "../../helpers/api.js";
import PrimaryButton from "@/components/all/PrimaryButton.vue";
import {Alert} from "@/helpers/Config.js";
import {useConterStore} from "@/store/counter.js";
import ModalCentered from "@/components/all/ModalCentered.vue";
import BtnBox from "@/components/all/BtnBox.vue";
import PrimaryBtn from "@/components/all/PrimaryBtn.vue";
import DefaultSelect from "@/ui-components/Forms/DefaultSelect.vue";
import ImageInput from "@/components/all/ImageInput.vue";

export default {
    components: {ImageInput, DefaultSelect, PrimaryBtn, BtnBox, ModalCentered, PrimaryButton, DefaultInput, Page},
    setup() {
        const counterStore = useConterStore();
        return {counterStore}
    },
    props: {
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
            roles: []
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
        async show(id) {
            try {
                const response = await userShow(id);
                this.item = response.data;
                this.name = response.data.name;
                this.login = response.data.login;
                this.email = response.data.email;
                this.phone = response.data.phone;
                this.image = response.data.image[0].url;
                if (this.item.id == this.counterStore.user.id) {
                    localStorage.setItem('user', JSON.stringify(response.data))
                    this.counterStore.updateUser(response.data)
                }
            } catch (error) {
                ApiError(this, error);
            }
        },
        async save() {
            try {
                this.item = '';
                this.name = '';
                this.login = '';
                this.email = '';
                this.phone = '';
                this.image = '';
                this.password = '';
                this.repeatPassword = '';
                this.position = '';
                this.role = '';
                // if (this.item.id == this.counterStore.user.id) {
                //     localStorage.setItem('user', JSON.stringify(response.data))
                //     this.counterStore.updateUser(response.data)
                // }
            } catch (error) {
                ApiError(this, error);
            }
        },
        async create() {
            try {
                this.loader = true;
                let data = {
                    name: this.name,
                    phone: this.phone,
                    login: this.login,
                    email: this.email,
                    image: this.image,
                    role_id: this.role,
                    position: this.position,
                    password: this.password,
                }
                console.log('Data', data)
                const response = await userCreate(data);
                if (response.status) {
                    Alert('success', this.$t('create'));
                    this.save();
                    this.loader = false;
                    this.$emit('onCreate', true)
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
        }
    },
    mounted() {
        // this.save()
        this.roleIndex()
    },
    watch: {
        Item: function (newVal, oldVal) { // watch it
            this.save()
        }
    }
}
</script>
<style></style>
