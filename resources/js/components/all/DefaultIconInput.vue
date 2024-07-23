<template>

    <div :class="Class" >
        <div>
            <label class="form-label" v-if="Label != '' ">{{Label}}</label>
            <div class="input-group" id="timepicker-input-group1">
                <input class="form-control " :class="Validated[Name] ? 'border-danger ' + inputClass : inputClass " :type="Type" :value="Value" :placeholder="Pholder" @input="this.$emit('onInput', $event.target.value)"    >
                <span class="input-group-text">
                    <slot></slot>
                </span>
            </div>


            <p  class="form-label text-danger" v-if="Validated[Name]" >{{Validated[Name]}}</p>
        </div>
    </div>

</template>
<script>
export default{
    props:{
        Class:{
            type: String,
            default: 'col-lg-12 col-sm-12'
        },
        inputClass:{
            type: String,
            default: ''
        },
        Name:{
            type: [String],
            default: ''
        },
        Label:{
            type:String,
            default: 'Label title'
        },
        Pholder:{
            type:String,
            default: 'enter here...'
        },
        Type:{
            type:String,
            default: 'text'
        },
        Value:{
            type: [String, Number],
            default: ''
        },
        Validated:{
            type: [Array, Object, String],
            default: []
        }
    },
}

</script>
<style>

</style>
