<template>


    <!--begin::Group-->
    <div class="form-group row">
        <label class="col-xl-3 col-lg-3 col-form-label">{{Label}}</label>
        <div class="col-lg-9 col-xl-9">

            <select  class="form-control form-control-solid form-control-lg" @input="this.$emit(`${Name}`, $event.target.value)">
                <option v-for="option in Options"
                        :name="Name"
                        :value="option['value']"
                        :selected ="ActiveOption == option['id']"
                >{{option['name'] }}</option>
            </select>

            <span class="form-text text-muted">{{Desc}}</span>
        </div>
    </div>
    <!--end::Group-->



</template>
<script >

    export default {
        props:{
            Name: {
                type: String,
                default: 'Input_name'
            },
            Value: {
                type: String,
                default: ''
            },

            Desc: {
                type: String,
                default: 'If you want your invoices addressed to a company. Leave blank to use your'
            },

            Label: {
                type: String,
                default: 'Input Label'
            },
            Options: {
                type: Array,
                default: [
                    {
                        name: 'Osio',
                        value: '1'
                    },

                ]
            },
            ActiveOption:{
                type: [String, Number],
                default: 0
            }


        }



    }

</script>
