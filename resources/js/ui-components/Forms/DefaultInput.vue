<template>

    <div :class="Class" >
        <div>
            <label class="form-label">{{Label}}</label>
            <input class="form-control" :type="Type" :value="Value" :placeholder="Pholder" @input="this.$emit('onInput', $event.target.value)">
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
        Name:{
            type: [String],
            default: []
        },
        Label:{
            type:String,
            default: 'Label title'
        },
        Pholder:{
            type:String,
            default: ''
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
    }

}

</script>
