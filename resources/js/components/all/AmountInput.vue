<template>

    <div :class="Class" >
        <div>
            <label class="form-label" v-if="Label != '' ">{{Label}}</label>
            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
              <span class="input-group-btn input-group-prepend">
                <button @click="this.$emit('onMinus', true)" class="btn btn-primary bootstrap-touchspin-down" type="button">−</button>
              </span>
                <input class="form-control " :class="Validated[Name] ? 'border-danger ' + inputClass : inputClass " :type="Type" :value="Value" :placeholder="Pholder" @input="this.$emit('onInput', $event.target.value)"    >

                <span class="input-group-btn input-group-append">
                <button @click="this.$emit('onPlus', true)" class="btn btn-primary bootstrap-touchspin-up" type="button">+</button>
              </span>
            </div>
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
