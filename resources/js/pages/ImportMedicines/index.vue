<template>
    <Page Title=""
          :Links="[
                    {
                        path: '/admin/documents',
                        name: $t('ImportDocuments'),
                        status: false
                    },
                     {
                        path: '/',
                        name: $t('RegistrationMedicines'),
                        status: true
                    },
                ]">
        <div class="row"  >
            <Header :document="document" />
            <Search  :isChange="change" @onAdd="addItem($event)" />
            <BasicTable
                :Th="[$t('No'),
                    $t('Picture'),
                    $t('ModalName'),
                    $t('Batch'),
                    $t('ExpiryDateFinished'),
                    $t('BoxSize'),
                    $t('BuyPrice'),
                    $t('Amount'),
                    $t('Subtotal'),
                    $t('Settings'),]"
                Title=""
                Col="col-lg-12"
            >
                <tr v-for="(item, index) in medicines" >
                    <td>
                        {{ index + 1 }}
                    </td>
                    <td>
                        <div class="table_image"  :style="'background-image: url('+ item.image[0].url +')'"></div>
                    </td>
                    <td>
                        <p class="m-0" style=" text-wrap: wrap; min-width: 150px">{{ item.name }}</p>
                        <p class="font-size-10 m-0" style="text-wrap: wrap" >{{ item.generic_name }}</p>

                    </td>
                    <td>
                        <BasicInput
                            Label=""
                            style="max-width: 150px"
                            Name="batch_name"
                            :Pholder="$t('Batch')"
                            Type="text"
                            :Value="medicines[index]['batch_name']"
                            :Validated="this.dataErrors.includes('batch'+item.sortId) ? errors : '' "
                            @onInput="medicines[index]['batch_name'] = $event, validator(item, index)"
                        />
                    </td>
                    <td>
                        <BasicInput
                            Label=""
                            Name="date"
                            Type="date"
                            :Value="medicines[index]['expiry_date_finished']"
                            :Validated="this.dataErrors.includes('date'+item.sortId) ? errors : '' "
                            @onInput="medicines[index]['expiry_date_finished'] = $event, validator(item, index)"
                        />
                    </td>
                    <td>
                        <BasicSelect
                            Label=""
                            Name="size_type_id"
                            @onInput="medicines[index]['box_size_id'] = $event"
                        >
                            <option v-for="boxSize in boxSizes" :value="boxSize.id" :selected="boxSize.id == item.box_size_id">{{boxSize.name}}</option>
                        </BasicSelect>
                    </td>

                    <td>
                        <DefaultIconInput
                            Label=""
                            Name="buy_price"
                            Type="text"
                            :Validated="this.dataErrors.includes('buy_price'+item.sortId) ? errors : '' "
                            :Value="counterStore.formatNumber(item.buy_price)"
                            @onInput="changePrice($event, index) , isChange = !isChange"
                            :inputClass=" 'medicinePrice' + index"
                        >
                            {{item.currency.sign}}
                        </DefaultIconInput>
                    </td>
                    <td>
                        <BasicInput
                            style="max-width: 120px"
                            Label=""
                            :Pholder="$t('Amount')"
                            Name="buy_amount"
                            :Validated="this.dataErrors.includes('buy_amount'+item.sortId) ? errors : '' "
                            Type="number"
                            :Value="item.buy_amount"
                            @onInput="medicines[index]['buy_amount'] = $event, isChange = !isChange"
                        />
                    </td>
                    <td>{{ counterStore.formatNumber( (Number(item.buy_price) * Number(item.buy_amount)).toFixed(2) )}} {{item.currency.sign}}</td>

                    <td>
                        <PrimaryIconBtn v-if="counterStore.hasRole('Documents-update')" @click="change = item.id, medicines.splice(index, 1), deleteError(item.sortId)" class="bg-danger border-danger" Icon="bx bx-trash-alt"/>
                    </td>

                </tr>

<!--                <Paginate-->
<!--                    Cols="8"-->
<!--                    v-if="last_page != 1"-->
<!--                    :currentPage="this.current_page"-->
<!--                    :totalPages="this.last_page"-->
<!--                    @changePage="indexPaginates($event)"-->
<!--                />-->

                <GrowingLoader v-if="loader" Cols="8"/>

            </BasicTable>
            <Report @dataErrors="dataErrors = $event" :medicines="medicines" :document="document" :isChange="isChange" />
        </div>

        <CreateMedicine
            crud="create"
            :medicineCategories="medicineCategories"
            :boxSizes="boxSizes"
            :drugCompanies="drugCompanies"
            :sizeTypes="sizeTypes"
            @indexCategoryActives="indexCategoryActives()"
            @indexCompaniesActives="indexCompaniesActives()"
            @indexBoxSizesActives="indexBoxSizesActives()"
            @indexTypesActives="indexTypesActives()"
            :mloader="mloader"
            @onCreate=""
        />


    </Page>
</template>
<script>
    import Page from "@/components/layout/Page.vue";
    import {ApiError} from "@/helpers/Config.js";
    import {Alert} from "@/helpers/Config.js";
    import {useConterStore} from "@/store/counter.js";
    import BasicTable from "@/components/all/BasicTable.vue";
    import {
        box_sizeActives,
        drug_companyActives,
        size_typeActives,
        medicine_categoryActives,
        payment_types, documentShow
    } from "@/helpers/api.js";
    import GrowingLoader from "@/components/all/GrowingLoader.vue";
    import PrimaryButton from "@/components/all/PrimaryButton.vue";
    import PrimaryIconBtn from "@/components/all/PrimaryIconBtn.vue";
    import ModalCentered from "@/components/all/ModalCentered.vue";
    import PrimaryBtn from "@/components/all/PrimaryBtn.vue";
    import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
    import Paginate from "@/components/all/Paginate.vue";
    import DefaultSelect from "@/ui-components/Forms/DefaultSelect.vue";
    import Header from './header.vue';
    import Report from './report.vue';
    import CreateMedicine from '../Medicines/create.vue';
    import Create from "@/pages/Medicines/create.vue";
    import Update from "@/pages/Medicines/update.vue";
    import Search from "./search.vue";
    import DefaultIconInput from "@/components/all/DefaultIconInput.vue";
    import IconSelect from "@/components/all/IconSelect.vue";
    import BasicInput from "@/components/all/BasicInput.vue";
    import BasicSelect from "@/components/all/BasicSelect.vue";
    export default {
        components: {
            BasicSelect,
            BasicInput,
            IconSelect,
            DefaultIconInput,
            Update,
            Create,
            DefaultSelect,
            Paginate,
            DefaultInput,
            PrimaryBtn,
            ModalCentered, PrimaryIconBtn, PrimaryButton, GrowingLoader, BasicTable, Page,Header, Report,Search, CreateMedicine},
        setup(){
            const counterStore = useConterStore();
            return{counterStore}
        },
        data(){return{
            change: false,
            isChange: false,
            items: [],
            mloader: false,
            item: [],
            boxItem: [],
            paginateCount: 10,
            last_page: 1,
            current_page: 1,
            boxLast_page: 1,
            boxCurrent_page: 1,
            column: 'id',
            type: 'desc',
            errors: {
                date: this.$t('dateRequired'),
                batch_name: this.$t('BatchValidated'),
                buy_amount: this.$t('buyAmountError'),
                buy_price: this.$t('buyPriceError')
            },
            loader: false,
            boxLoader: false,
            boxItems: [],
            warehouses: Object,
            suppliers: Object,
            medicineCategories: [],
            boxSizes: [],
            drugCompanies: [],
            sizeTypes: [],
            medicines: [],
            dataErrors: [],
            paymentTypes: [],
            amount_paid: 0,
            document: [],
            sortId: 1,

        }},
        methods:{
            validator(medicine, index){
                let listErrors = [];
                if (medicine.batch_name == null || medicine.batch_name.length == 0)
                {
                    listErrors.push('batch'+medicine.sortId);
                }

                if (medicine.expiry_date_finished == null || this.isDateBeforeToday(medicine.expiry_date_finished))
                {
                    listErrors.push('date'+medicine.sortId);
                }
                if (!this.isNumber(medicine.buy_price))
                {
                    listErrors.push('buy_price'+medicine.sortId);
                }
                if (!this.isNumber(medicine.buy_amount) || medicine.buy_amount <= 0)
                {
                    listErrors.push('buy_amount'+medicine.sortId);
                }
                this.dataErrors = listErrors;
                if (dataErrors.length > 0 || this.medicines == []){
                    Alert('error', this.$t('formError'))
                    return false;
                }else if(this.paid > this.subtotal){
                    Alert('error', this.$t('TheIncreased'))
                    return false;
                }else if(this.paid > 0 && this.payment_type_id < 1){
                    Alert('error', this.$t('PaymentTyperequired'))
                    return false;
                }
                return true;
            },
            isNumber(value) {
                // Agar value string bo'lsa, raqamga aylantirishga harakat qilish
                const number = parseFloat(value);
                // NaN yoki typeof tekshirish orqali raqam ekanligini aniqlash
                return !isNaN(number) && typeof number === 'number';
            },
            isDateBeforeToday(dateString) {
                // Parametr sifatida kelgan sana satrini Date obyektiga o'girib oling
                const inputDate = new Date(dateString);

                // Hozirgi sanani Date obyektiga o'girib oling
                const today = new Date();

                // Hozirgi sananing vaqtini nolga qaytarib oling (faqat sanani hisobga olish uchun)
                today.setHours(0, 0, 0, 0);

                // Input sanani vaqtini ham nolga qaytarib oling (faqat sanani hisobga olish uchun)
                inputDate.setHours(0, 0, 0, 0);

                // Input sanani hozirgi sanadan oldin yoki yo'qligini tekshiring
                return inputDate <= today;
            },
            deleteError(id){
                this.isChange = !this.isChange;
                this.dataErrors = this.dataErrors.filter(number => (number != 'date'+id && number != 'buy_price'+id && number != 'bu_amount'+id ));
            },
            async show(){
                try {
                    const response = await documentShow(this.$route.query.id);
                    if(response.data.status == 5){
                        Alert('info', this.$t('SavedDocumentError'))
                        this.$router.push('/admin/documents');
                    }
                    this.document = response.data;

                }catch(error){
                    ApiError(this, error);
                }
            },

            changePrice(price, index){
                let newMedicine = { ...this.medicines[index] }; // Yangi nusxa yaratish
                let amount = this.counterStore.inputNumberFormat('medicinePrice' + index, newMedicine['buy_price'], price);
                newMedicine['buy_price'] = amount;
                newMedicine['batch_name'] = '';
                this.medicines[index] = newMedicine; // Yangi nusxani yangilash
            },
            addItem(item) {
                let id = this.sortId + 1;
                let newMedicine = { ...item };
                newMedicine['sortId'] = id;
                newMedicine['buy_amount'] = 1;
                this.sortId = id;

                this.medicines.push(newMedicine);

                this.isChange = !this.isChange;
            },

            async search(text = ''){
                try {
                    this.loader = true;
                    if (text == ''){
                        this.indexPaginates();
                        return true;
                    }
                    const response = await documentSearch(text);
                    this.items = response.data;
                    this.loader = false;
                    if (!response.status){
                        Alert('error', this.$t('formError'));
                        this.loader = false;
                        return false;
                    }
                    this.loader = false;
                    return true;
                }catch(error){
                    ApiError(this, error);
                    this.loader = false;
                    return false;
                }
            },
            async delete(id){
                try {
                    if (!confirm(this.$t('DeleteAlert'))){
                        return false;
                    }
                    const response = await documentDelete(id);
                    if (response.status){
                        this.indexPaginates(this.current_page)
                        Alert('success', this.$t('delete'));
                        return;
                    }
                    Alert('error', this.$t('formError'));
                    return false;
                }catch(error){
                    ApiError(this, error);
                    return false;
                }
            },
            async indexCategoryActives() {
                try {
                    this.mloader = true;
                    const response = await medicine_categoryActives();
                    this.medicineCategories = response.data;
                    this.mloader = false;
                } catch (error) {
                    ApiError(this, error);
                }
            },
            async indexBoxSizesActives() {
                try {
                    this.mloader = true;
                    const response = await box_sizeActives();
                    this.boxSizes = response.data;
                    this.mloader = false;
                } catch (error) {
                    ApiError(this, error);
                }
            },
            async indexCompaniesActives() {
                try {
                    this.mloader = true;
                    const response = await drug_companyActives();
                    this.drugCompanies = response.data;
                    this.mloader = false;
                } catch (error) {
                    ApiError(this, error);
                }
            },
            async indexTypesActives() {
                try {
                    this.mloader = true;
                    const response = await size_typeActives();
                    this.sizeTypes = response.data;
                    this.mloader = false;
                } catch (error) {
                    ApiError(this, error);
                }
            },
        },
        mounted() {
            this.show();
            this.indexCategoryActives()
            this.indexBoxSizesActives()
            this.indexCompaniesActives()
            this.indexTypesActives()
        }
    }
</script>
<style></style>
