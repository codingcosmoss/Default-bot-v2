<template>
    <!--    Modal   -->
    <ModalCentered :Title="$t('Update')" ModalName="customerUpdate"  :isModalFooter="false">
        <div class="row"  >
            <BaseBox Col="col-xl-12" Title="">
                <ImageInput
                    :Title="$t('ProfilPhoto')"
                    Name="customerUpdateImage"
                    @customerUpdateImage="image = $event, delete this.errors.image"
                    :Validated="errors"
                    :Image="image"
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
                        :Label="$t('Phone')"
                        Name="phone"
                        Type="text"
                        :Validated="errors"
                        :Value="phone"
                        @onInput="phone = $event,  delete this.errors.phone"
                        Class="col-lg-6 col-sm-12"
                    />
                </div>

                <div class="row">

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
                    <DefaultInput
                        :Label="$t('Address')"
                        Name="address"
                        Type="text"
                        :Validated="errors"
                        :Value="address"
                        @onInput="address = $event,  delete this.errors.address"
                        Class="col-lg-6 col-sm-12"
                    />
                </div>

            </BaseBox>
            <BtnBox>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ $t('Close') }}</button>&nbsp;&nbsp;
                <PrimaryBtn  :Loader="loader" @onButton="update()">{{$t('Save')}}</PrimaryBtn>
            </BtnBox>


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
    roles,
    userUpdate,
    userShow,
    userDelete,
    userPaginates,
    userActives,
    userOrderBys,
    userUpdatePassword,
    customerCreate, customerUpdate, customerShow
} from "../../helpers/api.js";
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
            address: '',
            phone: '',
            email: '',
            image: '',
        }
    },
    methods: {
        async show(id) {
            try {
                const response = await customerShow(id);
                this.item = response.data;
                this.name = response.data.name;
                this.login = response.data.login;
                this.email = response.data.email;
                this.phone = response.data.phone;
                this.image = response.data.image[0].url;
            } catch (error) {
                ApiError(this, error);
            }
        },
        save(data){
            this.item = data;
            this.name = data.name;
            this.address = data.address;
            this.email = data.email;
            this.phone = data.phone;
            this.image = data.image != null ? data.image[0].url : '';
        },
        async update() {
            try {
                this.loader = true;

                let data = {
                    name: this.name,
                    phone: this.phone,
                    address: this.address,
                    email: this.email,
                    image: this.image,
                }

                const response = await customerUpdate(this.Item.id, data);
                if (response.status) {
                    this.show(response.data.id)
                    Alert('success', this.$t('update'));
                    this.loader = false;
                    this.counterStore.hiddenModal('customerUpdate');
                    this.$emit('onUpdate', true)
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

    watch: {
        Item: function (newVal, oldVal) { // watch it
            this.save(this.Item)
        }
    }
}
</script>
<style></style>
