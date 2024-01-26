<template>


    <!--begin::Group-->
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label">{{Label}}</label>
        <div class="col-lg-9 col-xl-9">
            <textarea :class=" Text == '' ? 'inputError' : '' "  rows="8"
                class="form-control form-control-solid form-control-lg"
                :name="Name"
                :placeholder="Pholder"
                @input = "onInput($event)"
                 required
            >{{Value}}</textarea>
            <span class="form-text text-muted">{{Desc}}</span>
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
                type: String,
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
            }

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
