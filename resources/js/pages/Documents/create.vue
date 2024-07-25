<template>
    <!--    Modal   -->
    <ModalCentered :Title="$t('NewImportMedicines')" ModalName="documentCreate"  :isModalFooter="false">
        <div class="row"  >
            <div v-if="mloader" class="modal_loader">
                <GrowingLoader></GrowingLoader>
            </div>
            <BaseBox Col="col-xl-12" Title="">

                <div class="row">

                    <ImageInput
                        :Title="$t('SketchFile') + ' (jpeg, png, jpg, svg, doc, docx, xls)'"
                        Name="documentCreateFile"
                        @documentCreateFile="file = $event, delete this.errors.image"
                        :Validated="errors"
                        Accept="*"
                    />

                    <DefaultSelect
                        :Label="$t('Warehouse')"
                        Name="warehouse_id"
                        Type="text"
                        :Validated="errors"
                        @onInput="warehouse_id = $event,  delete this.errors.warehouse_id"
                    >
                        <option>---</option>
                        <option v-for="warehouse in warehouses" :value="warehouse.id" :selected="warehouse_id == warehouse.id" >{{warehouse.name}}</option>
                    </DefaultSelect>

                    <DefaultSelect
                        :Label="$t('Supplier')"
                        Name="supplier_id"
                        Type="text"
                        :Validated="errors"
                        @onInput="supplier_id = $event,  delete this.errors.supplier_id"
                    >
                        <option>---</option>
                        <option v-for="supplier in suppliers" :value="supplier.id" :selected="supplier_id == supplier.id" >{{supplier.name}}</option>
                    </DefaultSelect>



                    <DefaultInput
                        :Label="$t('ImportedDate')"
                        Name="date"
                        Type="date"
                        :Validated="errors"
                        :Value="date"
                        @onInput="date = $event,  delete this.errors.date"
                    />
                </div>

            </BaseBox>

            <BtnBox>
                <button @click="this.$emit('onClose')" type="button" class="btn btn-light" data-bs-dismiss="modal">{{ $t('Close') }}</button>&nbsp;&nbsp;
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
    documentCreate, suppliers, warehouses
} from "../../helpers/api.js";
import PrimaryButton from "@/components/all/PrimaryButton.vue";
import {Alert} from "@/helpers/Config.js";
import {useConterStore} from "@/store/counter.js";
import ModalCentered from "@/components/all/ModalCentered.vue";
import BtnBox from "@/components/all/BtnBox.vue";
import PrimaryBtn from "@/components/all/PrimaryBtn.vue";
import DefaultSelect from "@/ui-components/Forms/DefaultSelect.vue";
import ImageInput from "@/components/all/ImageInput.vue";
import GrowingLoader from "@/components/all/GrowingLoader.vue";

export default {
    components: {
        GrowingLoader,
        ImageInput, DefaultSelect, PrimaryBtn, BtnBox, ModalCentered, PrimaryButton, DefaultInput, Page},
    setup() {
        const counterStore = useConterStore();
        return {counterStore}
    },
    props: {
        Item:{
            type: Object,
            default: []
        },
        warehouses: Object,
        suppliers: Object,
        mloader: Boolean,
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
            warehouse_id: null,
            supplier_id: null,
            date: '',
            file: '',
            // objects

        }
    },
    methods: {
        async show(id) {
            try {
                // const response = await userShow(id);
                // this.item = response.data;
                // this.warehouse_id = response.data.warehouse_id;
                // this.supplier_id = response.data.supplier_id;
                // this.date = response.data.date;
            } catch (error) {
                ApiError(this, error);
            }
        },
        async save() {
            this.item = '';
            this.warehouse_id = null;
            this.supplier_id = null;
            this.file = null;
            this.date = this.counterStore.currentDate();
        },
        async create() {
            try {
                this.loader = true;

                let data = {
                    warehouse_id: this.warehouse_id,
                    supplier_id: this.supplier_id,
                    date: this.date,
                    image: this.file,
                }

                const response = await documentCreate(data);
                if (response.status) {
                    Alert('success', this.$t('create'));
                    this.save();
                    this.loader = false;
                    this.errors = [];
                    this.counterStore.hiddenModal('documentCreate');
                    this.$router.push({ path:'/admin/import', query:{id: response.data.id} });
                    this.$emit('onCreate', true)
                    return true;
                }
                this.errors = response.errors;
                if (this.errors['image']){
                    this.file = null;
                }
                Alert('error', this.$t('formError'));
                this.loader = false;
                return false;
            } catch (error) {
                ApiError(this, error);
                this.loader = false;
                return false;
            }
        },
    },
    mounted() {
        this.save()
    },
    watch: {
        // Item: function (newVal, oldVal) { // watch it
        //     this.save()
        // }
    }
}
</script>
<style></style>
