<template>
    <!--    Modal   -->
    <ModalCentered :Title="$t('Update')" ModalName="expense_categoryUpdate"  :isModalFooter="false">
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
                    <DefaultInput
                        :Label="$t('Desc')"
                        Name="description"
                        Type="text"
                        :Validated="errors"
                        :Value="description"
                        @onInput="description = $event,  delete this.errors.description"
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
    expense_categoryUpdate, expense_categoryShow
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
            description: '',
        }
    },
    methods: {
        async show(id) {
            try {
                const response = await expense_categoryShow(id);
                this.item = response.data;
                this.name = response.data.name;
                this.description = response.data.description;
            } catch (error) {
                ApiError(this, error);
            }
        },
        save(data){
            this.item = data;
            this.name = data.name;
            this.description = data.description;
        },
        async update() {
            try {
                this.loader = true;

                let data = {
                    name: this.name,
                    description: this.description,
                }

                const response = await expense_categoryUpdate(this.Item.id, data);
                if (response.status) {
                    this.show(response.data.id)
                    Alert('success', this.$t('update'));
                    this.loader = false;
                    this.counterStore.hiddenModal('expense_categoryUpdate');
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
