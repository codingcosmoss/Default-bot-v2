<template>
    <!--    Modal   -->
    <ModalCentered :Title="$t('Update')" ModalName="boxSizeUpdate"  :isModalFooter="false">
        <div class="row"  >
            <BaseBox Col="col-xl-12" Title="">

                <div class="row">
                    <DefaultInput
                        :Label="$t('DataName')"
                        Name="name"
                        Type="text"
                        :Validated="errors"
                        :Value="name"
                        @onInput="name = $event,  delete this.errors.name"
                    />
                    <DefaultInput
                        :Label="$t('Size')"
                        Name="size"
                        Type="number"
                        :Validated="errors"
                        :Value="size"
                        @onInput="size = $event,  delete this.errors.size"
                    />
                    <DefaultInput
                        :Label="$t('SizeType')"
                        Name="sign"
                        Type="text"
                        :Validated="errors"
                        :Value="sign"
                        @onInput="sign = $event,  delete this.errors.sign"
                    />
                    <div class="col-12 d-flex flex-column">
                        <label class="form-label" >{{ $t('Status') }} </label>
                        <input type="checkbox" id="box_size_create" switch="none"  @input="status = status == 1 ? 0 : 1" :checked="status == 1 ? true : false" >
                        <label for="box_size_create" data-on-label="On" data-off-label="Off"></label>
                    </div>
                </div>

            </BaseBox>
            <BtnBox>
                <button @click="this.$emit('onClose')" type="button" class="btn btn-light" data-bs-dismiss="modal">{{ $t('Close') }}</button>&nbsp;&nbsp;
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
    userShow, box_sizeUpdate
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
            size: "",
            sign: 'piece',
            name: '',
            email: '',
            image: '',
        }
    },
    methods: {
        async show(id) {
            try {
                const response = await userShow(id);
                this.item = response.data;
                this.size = response.data.name;
                this.sign = response.data.name;
                this.name = response.data.name;
                this.status = response.data.status;
            } catch (error) {
                ApiError(this, error);
            }
        },
        async save() {
            this.item = '';
            this.size = '';
            this.sign = 'piece';
            this.name = '';
            this.status = 1;
        },
        async save2() {
            this.item = this.Item;
            this.size = this.Item.size;
            this.sign = this.Item.sign;
            this.name = this.Item.name;
            this.status = this.Item.status;
        },
        async update() {
            try {
                this.loader = true;

                let data = {
                    size: this.size,
                    sign: this.sign,
                    name: this.name,
                    status: this.status,
                }

                const response = await box_sizeUpdate(this.Item.id, data);
                if (response.status) {
                    Alert('success', this.$t('create'));
                    this.save();
                    this.loader = false;
                    this.errors = [];
                    this.counterStore.hiddenModal('boxSizeUpdate');
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
            this.save2()
        }
    }
}
</script>
<style></style>
