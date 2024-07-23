<template>
    <!--    Modal   -->
    <ModalCentered :Title="$t('Update')" ModalName="payment_typeUpdate"  :isModalFooter="false">
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
                        <label class="form-label" >{{ $t('Status') }}</label>
                        <input type="checkbox" id="payment_type_update" switch="none" @input="status = status == 1 ? 0 : 1" :checked="status == 1 ? true : false" >
                        <label for="payment_type_update" data-on-label="On" data-off-label="Off"></label>
                    </div>
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

    payment_typeShow,
    payment_typeUpdate
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
                const response = await payment_typeShow(id);
                this.item = response.data;
                this.name = response.data.name;
                this.status = response.data.status;
            } catch (error) {
                ApiError(this, error);
            }
        },
        save() {
            this.item = this.Item;
            this.payment_type_id = this.Item.payment_type_id;
            this.box_size_id = this.Item.box_size_id;
            this.drug_company_id = this.Item.drug_company_id;
            this.name = this.Item.name;
            this.generic_name = this.Item.generic_name;
            this.buy_price = this.Item.buy_price;
            this.price = this.Item.price;
            this.qr_code = this.Item.qr_code;
            this.hns_code = this.Item.hns_code;
            this.desc = this.Item.desc;
            this.strength = this.Item.strength;
            this.shelf = this.Item.shelf;
            this.vat = this.Item.vat;
            this.igta = this.Item.igta;
            this.status = this.Item.status;
            console.log('Item', this.Item)
        },
        async update() {
            try {
                this.loader = true;

                let data = {
                    name: this.name,
                    status: Number(this.status),
                }
                console.log(data)

                const response = await payment_typeUpdate(this.Item.id, data);
                if (response.status) {
                    Alert('success', this.$t('create'));
                    // this.show(response.data.id);
                    this.errors = [];
                    this.loader = false;
                    this.counterStore.hiddenModal('payment_typeUpdate');
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
