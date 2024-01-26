<template>


    <!--begin::Group-->
    <div class="form-group row">
    <label class="col-xl-3 col-lg-3 col-form-label">{{Label}}</label>
        <div class="col-lg-9 col-xl-9">
            <input class="form-control form-control-solid form-control-lg " :class=" Text == false ? 'inputError' : '' "
                       :name="Name" :type="Type" :value="Value"
                       :placeholder="Pholder"
                       @input = "onInput($event)"
                       required
                    />
            <span v-if="Error" class="form-text text-muted">{{Desc}}</span>
            <span v-else class="form-text text-muted" style="color: darkred !important;"> Bunday nom mavjud !</span>
        </div>
    </div>
    <!--end::Group-->



</template>
<script >

    export default {
        data(){
            return{
                Text: true
            }
        },
        props:{

            Name: {
                type: String,
                default: 'Input_name'
            },
            Value: {
                type: [String, Number],
                default: ''
            },
            Type: {
                type: String,
                default: 'Input_value'
            },
            Desc: {
                type: String,
                default: 'If you want your invoices addressed to a company. Leave blank to use your'
            },
            Pholder: {
                type: String,
                default: 'Input Plaseholder'
            },
            Label: {
                type: String,
                default: 'Input Label'
            },
            Error: {
                type: Boolean,
                default: true
            },


        },

        methods:{
            onInput( e){
                if (e.target.value == ''){
                    this.Text = false
                }else {
                    this.Text = true;
                }
                this.$emit(`${this.Name}`, e.target.value)
            }
        }


    }

</script>


<style>

    .inputError{
        border: 1px solid crimson !important;
    }
</style>
