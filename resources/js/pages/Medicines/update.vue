<template>
    <!--    Modal   -->
    <ModalCentered :Title="$t('Update')" ModalName="medicineUpdate" ModalTypes="modal-xl"  :isModalFooter="false">
        <div class="row position-relative"  >
            <div v-if="mloader" class="modal_loader">
                <GrowingLoader></GrowingLoader>
            </div>
            <BaseBox Col="col-xl-6" Title="">
                <ImageInput
                    :Title="$t('Photo')"
                    Name="medicineUpdateImage"
                    :Image="image"
                    @medicineUpdateImage="image = $event, delete this.errors.image"
                    :Validated="errors"
                />

                <div class="row">
                    <DefaultInput
                        :Label="$t('DataName')"
                        Name="name"
                        Type="text"
                        :Validated="errors"
                        :Value="name"
                        @onInput="name = $event,  delete this.errors.name"
                        Class="col-lg-6 col-sm-12"
                    />
                    <DefaultInput
                        :Label="$t('GenericName')"
                        Name="generic_name"
                        Type="text"
                        :Validated="errors"
                        :Value="generic_name"
                        @onInput="generic_name = $event,  delete this.errors.generic_name"
                        Class="col-lg-6 col-sm-12"
                    />
                </div>
                <div class="row">
                    <DefaultSelect
                        :Label="$t('MedicineCategory')"
                        ModalName="medicine_categoryCreate"
                        :isButton="true"
                        Name="medicine_category_id"
                        :Validated="errors"
                        @onInput="medicine_category_id = $event,  delete this.errors.medicine_category_id"
                        Class="col-lg-6 col-sm-12"
                    >
                        <option selected>---</option>
                        <option v-for="medicineCategory in medicineCategories"  :selected="medicine_category_id == medicineCategory.id"  :value="medicineCategory.id" >{{medicineCategory.name}}</option>
                    </DefaultSelect>

                    <DefaultSelect
                        :Label="$t('BoxSizes')"
                        ModalName="boxSizeCreate"
                        :isButton="true"
                        Name="box_size_id"
                        :Validated="errors"
                        @onInput="box_size_id = $event,  delete this.errors.box_size_id"
                        Class="col-lg-6 col-sm-12"
                    >
                        <option v-for="boxSize in boxSizes" :value="boxSize.id" :selected="box_size_id == boxSize.id" >{{boxSize.name}}</option>
                    </DefaultSelect>

                </div>
                <div class="row">
                    <DefaultSelect
                        :Label="$t('DrugCompanies')"
                        Name="drug_company_id"
                        ModalName="drug_companyCreate"
                        :isButton="true"
                        :Validated="errors"
                        @onInput="drug_company_id = $event,  delete this.errors.drug_company_id"
                        Class="col-lg-6 col-sm-12"
                    >
                        <option selected>---</option>
                        <option v-for="drugCompany in drugCompanies" :value="drugCompany.id" :selected="drug_company_id == drugCompany.id" >{{drugCompany.name}}</option>
                    </DefaultSelect>

                    <DefaultSelect
                        :Label="$t('Strength')"
                        Name="size_type_id"
                        ModalName="size_typeCreate"
                        :isButton="true"
                        :Validated="errors"
                        @onInput="size_type_id = $event,  delete this.errors.size_type_id"
                        Class="col-lg-6 col-sm-12"
                    >
                        <option selected>---</option>
                        <option v-for="sizeType in sizeTypes"  :selected="size_type_id == sizeType.id" :value="sizeType.id" >{{sizeType.name}}</option>
                    </DefaultSelect>


                </div>

                <div class="row">
                    <DefaultInput
                        :Label="$t('BuyPrice') + ' (' + currency.sign + ')'"
                        Name="buy_price"
                        Type="text"
                        :Validated="errors"
                        :Value="counterStore.formatNumber(buy_price)"
                        @onInput="addBuyAmount($event), calculatorPracent(percentage), delete this.errors.buy_price"
                        Class="col-lg-6 col-sm-12"
                        inputClass ='buy_price'
                    />

                    <DefaultInput
                        :Label="$t('InterestSale') + '(%)'"
                        Name="percentage"
                        Type="Number"
                        :Validated="errors"
                        :Value="percentage"
                        @onInput=" calculatorPracent($event),  delete this.errors.percentage"
                        Class="col-lg-6 col-sm-12"
                        :Min="1"
                    />



                </div>
                <div class="row">

                    <DefaultInput
                        :Label="$t('PriceSale') + ' (' + currency.sign + ')'"
                        Name="selling_price"
                        Type="text"
                        :Validated="errors"
                        :Value="counterStore.formatNumber(selling_price)"
                        @onInput="calculatorPrice($event),  delete this.errors.selling_price"
                        Class="col-lg-6 col-sm-12 "
                        inputClass ='selling_price'

                    />
                    <DefaultInput
                        :Label="$t('SellingPrice') + ' (' + currency.sign + ')' "
                        :isDisabled="true"
                        Name="price"
                        Type="text"
                        :Validated="errors"
                        :Value="counterStore.formatNumber(price)"
                        Class="col-lg-6 col-sm-12"
                    />
                </div>




            </BaseBox>
            <BaseBox Col="col-xl-6" :Title="$t('OptionalFields')">


                <div class="row">

                    <DefaultInput
                        :Label="$t('HnsCode')"
                        Name="hns_code"
                        Type="text"
                        :Validated="errors"
                        :Value="hns_code"
                        @onInput="hns_code = $event,  delete this.errors.hns_code"
                        Class="col-lg-6 col-sm-12"
                    />
                    <DefaultInput
                        :Label="$t('QrCode')"
                        Name="qr_code"
                        Type="text"
                        :Validated="errors"
                        :Value="qr_code"
                        @onInput="qr_code = $event,  delete this.errors.qr_code"
                        Class="col-lg-6 col-sm-12"
                    />

                </div>
                <div class="row">

                    <DefaultInput
                        :Label="$t('Shelf')"
                        Name="shelf"
                        Type="text"
                        :Validated="errors"
                        :Value="shelf"
                        @onInput="shelf = $event,  delete this.errors.shelf"
                        Class="col-lg-6 col-sm-12"
                    />
                    <DefaultInput
                        :Label="$t('Vat') + ' (' + currency.sign + ')'"
                        Name="vat"
                        Type="number"
                        :Validated="errors"
                        :Value="vat"
                        @onInput="vat = $event,  delete this.errors.vat"
                        Class="col-lg-6 col-sm-12"
                    />
                </div>
                <div class="row">

                    <DefaultInput
                        :Label="$t('Igta') + ' (' + currency.sign + ')'"
                        Name="igta"
                        Type="number"
                        :Validated="errors"
                        :Value="igta"
                        @onInput="igta = $event,  delete this.errors.igta"
                        Class="col-lg-6 col-sm-12"
                    />
                    <DefaultTextarea
                        :Label="$t('Desc')"
                        Name="desc"
                        Type="text"
                        :Validated="errors"
                        :Value="desc"
                        @onInput="desc = $event,  delete this.errors.desc"
                        Class="col-lg-6 col-sm-12"
                    />

                </div>
                <div class="row">

                    <div class="col-lg-6 col-sm-12 d-flex flex-column">
                        <label class="form-label" >{{ $t('Status') }} </label>
                        <input type="checkbox" id="medicine_category_update_status" switch="none"  @input="status = status == 1 ? 0 : 1" :checked="status == 1 ? true : false" >
                        <label for="medicine_category_update_status" data-on-label="On" data-off-label="Off"></label>
                    </div>

                </div>

            </BaseBox>
            <BtnBox>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ $t('Close') }}</button>&nbsp;&nbsp;
                <PrimaryBtn  :Loader="loader" @onButton="update()">{{$t('Save')}}</PrimaryBtn>
            </BtnBox>

        </div>

    </ModalCentered>
    <CategoryCreate @onClose="opanModal()" @onCreate="this.$emit('indexCategoryActives', true), opanModal()"></CategoryCreate>
    <CompanyCreate @onClose="opanModal()" @onCreate="this.$emit('indexCompaniesActives', true), opanModal()"></CompanyCreate>
    <SizeCreate @onClose="opanModal()" @onCreate="this.$emit('indexBoxSizesActives', true), opanModal()"></SizeCreate>
    <TypeCreate @onClose="opanModal()" @onCreate="this.$emit('indexTypesActives', true), opanModal()"></TypeCreate>

</template>
<script>
import Page from "@/components/layout/Page.vue";
import {ApiError} from "@/helpers/Config.js";
import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
import {
 medicineUpdate
} from "../../helpers/api.js";
import PrimaryButton from "@/components/all/PrimaryButton.vue";
import {Alert} from "@/helpers/Config.js";
import {useConterStore} from "@/store/counter.js";
import ModalCentered from "@/components/all/ModalCentered.vue";
import BtnBox from "@/components/all/BtnBox.vue";
import PrimaryBtn from "@/components/all/PrimaryBtn.vue";
import DefaultSelect from "@/ui-components/Forms/DefaultSelect.vue";
import ImageInput from "@/components/all/ImageInput.vue";
import DefaultTextarea from "@/ui-components/Forms/DefaultTextarea.vue";
import CategoryCreate from '../MedicineCategories/create.vue';
import CompanyCreate from '../MedicineCategories/boxCreate.vue';
import SizeCreate from '../SizeTypes/boxCreate.vue';
import TypeCreate from '../SizeTypes/create.vue';
import Loader from "@/ui-components/Items/Loader.vue";
import GrowingLoader from "@/components/all/GrowingLoader.vue";

export default {
    components: {
        GrowingLoader,
        Loader,
        DefaultTextarea,
        ImageInput, DefaultSelect, CompanyCreate,SizeCreate,TypeCreate, PrimaryBtn, BtnBox, ModalCentered, PrimaryButton, DefaultInput, Page, CategoryCreate},
    setup() {
        const counterStore = useConterStore();
        return {counterStore}
    },
    props: {
        Item: Object,
        medicineCategories: Object,
        boxSizes: Object,
        drugCompanies: Object,
        sizeTypes: Object,
        hello: String,
        mloader: Boolean,
        crud: String
    },
    data() {
        return {
            currency:'',
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
            image: '',
            name: "",
            generic_name: "",
            buy_price: 0,
            price: 0,
            medicine_category_id: null,
            box_size_id: null,
            size_type_id: null,
            drug_company_id: null,
            qr_code: "",
            hns_code: "",
            strength: 0,
            shelf: "",
            vat: 0,
            igta: 0,
            desc: "",
            status: 1,
            percentage: 0,
            selling_price: 0
        }
    },

    methods: {
        calculatorPracent(pracent){
            this.percentage = pracent;
            let sum = (this.buy_price*pracent)/100;
            // this.addAmount(this.counterStore.formatNumber(sum));
            this.selling_price = sum;

            this.price = Number(this.buy_price) + Number(sum);
        },
        calculatorPrice(val){
            this.addAmount(val);
            let sum = (this.selling_price*100)/this.buy_price;
            this.calculatorPracent(sum)
        },
        addAmount(val){
            let formatAmount = this.counterStore.inputNumberFormat('selling_price', this.selling_price, val);
            this.selling_price = formatAmount;
        },
        addBuyAmount(val){
            let formatAmount = this.counterStore.inputNumberFormat('buy_price', this.buy_price, val);
            this.buy_price = formatAmount;
        },
        opanModal() {
            let modal = '';
            if (this.crud == 'update'){
                modal = 'medicineUpdate';
            }else {
                modal = 'medicineCreate';
            }
            const myModal = new bootstrap.Modal(document.getElementById(modal));
            myModal.show();
        },
        async show(id) {
            try {
                const response = await userShow(id);
                this.item = response.data;
                this.medicine_category_id = response.data.medicine_category_id;
                this.box_size_id = response.data.box_size_id;
                this.size_type_id = response.data.size_type_id;
                this.drug_company_id = response.data.drug_company_id;
                this.name = response.data.name;
                this.generic_name = response.data.generic_name;
                this.buy_price = response.data.buy_price;
                this.price = response.data.price;
                this.qr_code = response.data.qr_code;
                this.hns_code = response.data.hns_code;
                this.desc = response.data.desc;
                this.strength = response.data.strength;
                this.shelf = response.data.shelf;
                this.vat = response.data.vat;
                this.igta = response.data.igta;
                this.status = response.data.status;
                this.image = response.data.image[0].url;

            } catch (error) {
                ApiError(this, error);
            }
        },
        save2() {
            this.item = this.Item;
            this.image = this.Item.image[0].url;
            this.medicine_category_id = this.Item.medicine_category_id;
            this.box_size_id = this.Item.box_size_id;
            this.currency = this.Item.currency;
            this.size_type_id = this.Item.size_type_id;
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
            this.percentage = this.Item.percentage;
            this.selling_price = this.Item.selling_price;
        },
        async save() {
            this.item = [];
            this.image = '';
            this.medicine_category_id = null;
            this.box_size_id = null;
            this.size_type_id = null;
            this.drug_company_id = null;
            this.name = '';
            this.generic_name = '';
            this.buy_price = 0;
            this.price = 0;
            this.qr_code = '';
            this.hns_code = '';
            this.desc = '';
            this.strength = null;
            this.shelf = '';
            this.vat = 0;
            this.igta = 0;
            this.status = null;
            this.selling_price = 0;
            this.percentage = 0;
        },
        async update() {
            try {
                this.loader = true;
                let data = {
                    image: this.image,
                    medicine_category_id: this.medicine_category_id,
                    box_size_id: this.box_size_id,
                    size_type_id: this.size_type_id,
                    drug_company_id: this.drug_company_id,
                    name: this.name,
                    generic_name: this.generic_name,
                    buy_price: this.buy_price,
                    price: this.price,
                    qr_code: this.qr_code,
                    hns_code: this.hns_code,
                    desc: this.desc,
                    strength: this.strength,
                    shelf: this.shelf,
                    vat: this.vat,
                    igta: this.igta,
                    status: this.status,
                    selling_price: this.selling_price,
                    percentage: this.percentage,
                }

                const response = await medicineUpdate(this.Item.id, data);
                if (response.status) {
                    Alert('success', this.$t('update'));
                    this.counterStore.hiddenModal('medicineUpdate');
                    this.save();
                    this.loader = false;
                    this.$emit('onUpdate', true)
                    console.log('oke', this.loader);
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
