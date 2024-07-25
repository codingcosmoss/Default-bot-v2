<template>

    <div :class="Class" >
        <div>
            <label class="form-label" v-if="Label != '' ">{{Label}}</label>
            <input :disabled="isDisabled" class="form-control " :class="Validated[Name] ? 'border-danger ' + inputClass : inputClass " :type="Type" :value="Value" :placeholder="Pholder" @input="this.$emit('onInput', $event.target.value)"  :min="Min"   >
            <p  class="form-label text-danger" >{{Validated[Name]}}</p>
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
        Min:{
            type: Number,
            default: 0
        },
        isDisabled:{
            type: Boolean,
            default: false
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
