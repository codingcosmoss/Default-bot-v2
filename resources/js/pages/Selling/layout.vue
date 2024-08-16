<template>
    <div class="d-xl-flex selling_box selling_box1 ">
        <div class="w-100">
            <div class="d-md-flex selling_md_flex">

                <div class="w-100" >
                    <div class="card">
                        <div class="card-body selling_item_list position-relative">
                            <div class="p-3 pt-2 pb-0 bg-primary selling_search_box">
                                <div class=" d-flex flex-row ">
                                    <DefaultIconInput
                                        Label=""
                                        class="selling_input"
                                        inputClass="p-2"
                                        Class="col-lg-6 col-md-6 col-xl-12 col-sm-12"

                                        @onInput="this.$emit('onSearch', $event)"
                                    >
                                        <i class="bx bx-search-alt-2"></i>
                                    </DefaultIconInput>
                                    <DefaultSelect
                                        Label=""
                                        Class="col-lg-6 col-md-6 col-xl-12 col-sm-12"
                                    >
                                        <option>---</option>
                                        <option>---</option>
                                    </DefaultSelect>

                                </div>
                            </div>
                            <slot>

                            </slot>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end w-100 -->

                <div class="card w-100  me-md-3 " >
                    <div class="card-body p-0" >
                        <div class="row p-3">
                            <div class="col-xl-6 col-sm-6">
                                <DefaultSelect
                                    Label=""
                                ></DefaultSelect>
                            </div>
                            <div class="col-xl-6 col-sm-6 d-flex gap-2">
                                <button type="button" class="selling_btn btn btn-primary waves-effect waves-light">
                                    <i class="bx bx-smile font-size-16 align-middle me-2"></i> Primary
                                </button>
                                <button type="button" class=" btn btn-primary waves-effect waves-light">
                                    <i class="bx bx-smile font-size-16 align-middle me-2"></i> Primary
                                </button>
                            </div>
                        </div>
                        <div class="selling_left_table" >
                            <slot name="left" >

                            </slot>
                        </div>
                    </div>
                </div>
                <!-- filemanager-leftsidebar -->


            </div>
        </div>

        <div class="selling_main" >
            <slot name="main" >

            </slot>
        </div>

    </div>
</template>
<script>
import {defineComponent} from "vue";
import DefaultSelect from "@/ui-components/Forms/DefaultSelect.vue";
import PrimaryIconBtn from "@/components/all/PrimaryIconBtn.vue";
import DefaultIconInput from "@/components/all/DefaultIconInput.vue";

export default {
    components: {DefaultIconInput, PrimaryIconBtn, DefaultSelect},
    data(){return{
        searchMedicines:[],
        loader: false
    }},
    methods:{

    }
}

</script>
