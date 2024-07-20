<template>
    <!--    Modal   -->
    <ModalCentered :Title="$t('Create')" ModalName="drug_companyCreate"  :isModalFooter="false">
        <div class="row"  >
            <BaseBox Col="col-xl-12" Title="">

                <div class="row">
                    <DefaultInput
                        :Label="$t('ModalName')"
                        Name="name"
                        Type="text"
                        :Validated="errors"
                        :Value="name"
                        @onInput="name = $event,  delete this.errors.name"
                    />
                    <div class="col-12 d-flex flex-column">
                        <label class="form-label" >{{ $t('Status') }} </label>
                        <input type="checkbox" id="drug_company_create" switch="none"  @input="status = status == 1 ? 0 : 1" :checked="status == 1 ? true : false" >
                        <label for="drug_company_create" data-on-label="On" data-off-label="Off"></label>
                    </div>
                </div>

            </BaseBox>
            <BtnBox>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ $t('Close') }}</button>&nbsp;&nbsp;
                <PrimaryBtn  :Loader="loader" @onButton="create()">{{$t('Save')}}</PrimaryBtn>
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
    drug_companyCreate
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
            status: 1,
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
                const response = await userShow(id);
                this.item = response.data;
                this.name = response.data.name;
                this.status = response.data.status;
            } catch (error) {
                ApiError(this, error);
            }
        },
        async save() {
            try {
                this.item = '';
                this.name = '';
                this.status = 1;
            } catch (error) {
                ApiError(this, error);
            }
        },
        async create() {
            try {
                this.loader = true;

                let data = {
                    name: this.name,
                    status: this.status,
                }

                const response = await drug_companyCreate(data);
                if (response.status) {
                    Alert('success', this.$t('create'));
                    this.save();
                    this.loader = false;
                    this.errors = [];
                    this.counterStore.hiddenModal('drug_companyCreate');
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
    },
    watch: {
        Item: function (newVal, oldVal) { // watch it
            this.save()
        }
    }
}
</script>
<style></style>
