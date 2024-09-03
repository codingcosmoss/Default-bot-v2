<template>
    <!--    Modal   -->
    <ModalCentered :Title="$t('Create')" ModalName="expenseCreate"  :isModalFooter="false">
        <div class="row"  >
            <BaseBox Col="col-xl-12" Title="">
                <div class="row">
                    <DefaultInput
                        :Label="$t('Title')"
                        Name="title"
                        Type="text"
                        :Validated="errors"
                        :Value="title"
                        @onInput="title = $event,  delete this.errors.title"
                    />

                    <div class="row">
                        <DefaultInput
                            :Label="$t('Amount') + ' ('+ counterStore.user.currency.sign + ')'"
                            Name="amount"
                            Type="text"
                            :Validated="errors"
                            :Value="counterStore.formatNumber(this.amount)"
                            inputClass ='expense_amount'
                            @onInput="addAmount($event),  delete this.errors.amount"
                            Class="col-lg-9 col-sm-9"
                        />
                        <DefaultSelect
                            Class="col-lg-3 col-sm-3"
                            :Label="$t('Currency')"
                            Name="currency_id"
                            @onInput="currency_id = $event,  delete this.errors.currency_id"
                            :Validated="errors"
                        >
                            <option v-for="currency in currencies" :selected="currency.id == currency_id" :value="currency.id" >{{currency.sign}}</option>
                        </DefaultSelect>

                    </div>
                </div>

                <div class="row">
                    <DefaultInput
                        :Label="$t('Date')"
                        Name="date"
                        Type="date"
                        :Validated="errors"
                        :Value="date"
                        @onInput="date = $event,  delete this.errors.date"
                    />

                    <DefaultSelect
                        :Label="$t('ExpensesCategory')"
                        Name="expense_category_id"
                        @onInput="expense_category_id = $event,  delete this.errors.expense_category_id"
                        :Validated="errors"
                    >
                        <option selected>{{$t('ExpensesCategory')}}</option>
                        <option v-for="category in categories" :value="category.id" >{{category.name}}</option>
                    </DefaultSelect>
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
    expense_categoryShow,
    expenseCreate, expense_categorys, currencys
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
            categories: [],
            // forms
            title: '',
            date: '',
            amount: '',
            expense_category_id: '',
            currencies: [],
            currency_id: this.counterStore.user.currency_id,
        }
    },
    methods: {
        async getCurrencies(){
            try {
                this.loader = true;
                const response = await currencys();
                this.currencies = response.data;
                this.loader = false;
            }catch(error){
                ApiError(this, error);
            }
        },
        addAmount(val){
          let formatAmount = this.counterStore.inputNumberFormat('expense_amount', this.amount, val);
          this.amount = formatAmount;
        },
        async show(id) {
            try {
                const response = await userShow(id);
                this.item = response.data;
                this.date = response.data.name;
                this.title = response.data.login;
                this.amount = response.data.amount;
                this.currency_id = response.data.currency_id;
                this.expense_category_id = response.data.phone;
            } catch (error) {
                ApiError(this, error);
            }
        },
        async getCategories() {
            try {
                const response = await expense_categorys();
                this.categories = response.data;
            }catch(error){
                ApiError(this, error);
            }
        },
        async save() {
            try {
                this.item = '';
                this.date =  this.counterStore.currentDate();
                this.title = '';
                this.amount = '';
                this.currency_id = this.counterStore.user.currency_id;
                this.expense_category_id = '';
                let categories = this.categories;
                this.categories = [];
                this.categories = categories;
            } catch (error) {
                ApiError(this, error);
            }
        },
        async create() {
            try {
                this.loader = true;
                let data = {
                    title: this.title,
                    date: this.date,
                    currency_id: this.currency_id,
                    amount: Number(this.amount),
                    expense_category_id: this.expense_category_id,
                }

                const response = await expenseCreate(data);
                if (response.status) {
                    Alert('success', this.$t('create'));
                    this.save();
                    this.counterStore.hiddenModal('expenseCreate');
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
        this.save()
        this.getCategories()
        this.getCurrencies()
    },
    watch: {
        Item: function (newVal, oldVal) { // watch it
            this.save()
        }
    }
}
</script>
<style></style>
