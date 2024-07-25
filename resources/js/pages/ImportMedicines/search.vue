<template>
    <div class=" w-100 d-flex mb-2">

        <div class="col-5" style="z-index: 100">
            <div class="dropdown">
                <DefaultInput
                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"
                    Class="col-lg-12 col-sm-12   search_input"
                    Label=""
                    Name="name"
                    Type="text"
                    :Pholder="$t('SearchMedicines')"
                    @onInput="search($event)"
                />
                <div  class="dropdown-menu col-lg-12 col-sm-12"  aria-labelledby="dropdownMenuButton"  style="z-index: 1000">

                    <a  v-for="item in items" class="dropdown-item d-flex align-items-center "
                        :class="hasMedicines(item) ? 'bg-success-subtle' : '' "
                        @click="addMedicines(item)"
                    >
                        <div class="table_image search_medicines_img"  :style="'background-image: url('+ item.image[0].url +')'"></div>
                        {{ item.name }}
                        ({{ item.drug_company }})
                    </a>

                    <a v-if="loader" class="dropdown-item d-flex justify-content-center"><GrowingLoader></GrowingLoader></a>

                </div>
            </div>
        </div>

        <BtnBox>

            <PrimaryBtn v-if="counterStore.hasRole('Medicines-create')"  role="button" data-bs-toggle="modal" data-bs-target="#medicineCreate"  >{{$t('CreateMedicine')}}</PrimaryBtn>
        </BtnBox>

    </div>
</template>
<script>
import BaseBox from "@/components/global/BaseBox.vue";
import DefaultInput from "@/ui-components/Forms/DefaultInput.vue";
import PrimaryBtn from "@/components/all/PrimaryBtn.vue";
import {useConterStore} from "@/store/counter.js";
import BtnBox from "@/components/all/BtnBox.vue";
import {medicineActiveSearch} from "@/helpers/api.js";
import GrowingLoader from "@/components/all/GrowingLoader.vue";
import {ApiError} from "@/helpers/Config.js";

export default
{
    components:{GrowingLoader, BtnBox, BaseBox, DefaultInput, PrimaryBtn},
    props:{
        tableMedicines: Object,
        isChange: Object
    },
    watch: {
        isChange: function(newVal, oldVal) { // watch it
            console.log('oke', this.tableMedicines)
            this.medicines = this.medicines.filter(e => e.id != this.isChange);
        }
    },
    setup(){
        const counterStore = useConterStore();
        return{counterStore}
    },
    data(){return{
        items: [],
        loader: false,
        medicines: [],
    }},
    methods:{
        hasMedicines(item){
            let isItem = this.medicines.find(model => model.id == item.id );
            if (isItem){
                return true;
            }
            return false;
        },
        addMedicines(item){
            this.medicines.push(item)
            this.$emit('onAdd', item)
        },
        async search(text = ''){
            try {
                this.loader = true;
                const response = await medicineActiveSearch(text);
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

    },

}

</script>

<style></style>
